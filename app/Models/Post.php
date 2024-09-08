<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Translatable\HasTranslations;
use App\Enums\PostType;

class Post extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'title',
        'slug',
        'excerpt',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
            ->whereDate('published_at', '<', now());
    }

    public function scopeArticles(Builder $query): Builder
    {
        return $query->where('type', PostType::ARTICLE);
    }

    public function scopeProjects(Builder $query): Builder
    {
        return $query->where('type', PostType::PROJECT);
    }

    public function getLinkAttribute(): string
    {
        return route('article', $this);
    }
}
