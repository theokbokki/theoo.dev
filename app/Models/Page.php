<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['parent_id', 'title', 'content'])]
class Page extends Model
{
    use HasSlug, SoftDeletes;

    protected static function booted(): void
    {
        static::creating(fn (Page $page) => $page->path = $page->buildPath());

        static::updating(function (Page $page) {
            if ($page->getOriginal('parent_id') === null && $page->isDirty('parent_id')) {
                throw new LogicException('The garden root cannot be moved.');
            }

            $page->path = $page->buildPath();
        });

        static::updated(function (Page $page) {
            if (! $page->wasChanged('path')) {
                return;
            }

            $page->children()->withTrashed()->get()->each(function (Page $child) {
                $child->path = $child->buildPath();
                $child->save();
            });
        });

        static::deleting(function (Page $page) {
            if ($page->parent_id === null) {
                throw new LogicException('The garden root cannot be deleted.');
            }

            if ($page->isForceDeleting()) {
                return;
            }

            $page->children()->get()->each(fn (Page $child) => $child->delete());
        });

        static::restored(function (Page $page) {
            $page->children()->onlyTrashed()->get()->each(fn (Page $child) => $child->restore());
        });
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->extraScope(fn (Builder $query) => $query->where('parent_id', $this->parent_id));
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function buildPath(): string
    {
        if ($this->parent_id === null) {
            return '';
        }

        $parentPath = Page::withTrashed()->whereKey($this->parent_id)->value('path');

        return $parentPath === '' ? $this->slug : $parentPath.'/'.$this->slug;
    }

    public function url(): string
    {
        return route('pages.show', ['path' => $this->path ?: null]);
    }

    public function displayPath(): string
    {
        return $this->path === '' ? '/garden' : '/garden/'.$this->path;
    }
}
