<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\Exceptions\StaleSelfHealingUrl;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

#[Unguarded]
class Page extends Model
{
    use HasSlug, SoftDeletes;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->selfHealing();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function ancestors(): BelongsTo
    {
        return $this->parent()->with('ancestors');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getRouteKey(): mixed
    {
        if ($this->slug === '') {
            return '';
        }

        $key = $this->slug.'-'.$this->getKey();
        $path = $this->parentPath();

        return $path === '' ? $key : $path.'/'.$key;
    }

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        if (!$value) {
            return null;
        }

        $model = str($value)->afterLast('-') |> static::with('ancestors')->find(...);

        if (!$model) {
            return null;
        }

        if ($value !== $model->getRouteKey()) {
            throw new StaleSelfHealingUrl($model, $value);
        }

        return $model;
    }

    public function parentPath(): string
    {
        $segments = [];

        for ($current = $this->parent; $current; $current = $current->parent) {
            if ($current->slug !== '') {
                array_unshift($segments, $current->slug);
            }
        }

        return implode('/', $segments);
    }
}
