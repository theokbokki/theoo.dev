<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Spatie\Sluggable\Attributes\Sluggable;

#[Guarded([])]
#[Sluggable(from: 'title', to: 'slug')]
class Books extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

