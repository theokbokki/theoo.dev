<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Spatie\Sluggable\Attributes\Sluggable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Enums\LinkTagColor;

#[Guarded([])]
class LinkTag extends Model
{
    use HasSlug;

    public function casts(): array
    {
        return [
            'hue' => LinkTagColor::class,
        ];
    }

    public function links(): BelongsToMany
    {
        return $this->belongsToMany(Link::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
