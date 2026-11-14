<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Spatie\Sluggable\Attributes\Sluggable;

#[Guarded([])]
#[Sluggable(from: 'name', to: 'slug')]
class LinkTag extends Model
{
    public function links(): BelongsToMany
    {
        return $this->belongsToMany(Link::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
