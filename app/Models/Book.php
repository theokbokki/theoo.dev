<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Spatie\Sluggable\Attributes\Sluggable;
use App\Enums\BookStatus;

#[Guarded([])]
#[Sluggable(from: 'title', to: 'slug')]
class Book extends Model
{
    public function casts(): array
    {
        return [
            'status' => BookStatus::class,
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

