<?php

namespace App\Models;

use App\Enums\NoteStatus;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\Attributes\Sluggable;

#[Guarded([])]
#[Sluggable(from: 'title', to: 'slug')]
class Note extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'status' => NoteStatus::class,
        ];
    }
}
