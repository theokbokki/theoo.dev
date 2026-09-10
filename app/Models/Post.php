<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[Guarded([])]
class Post extends Model
{
    protected static function booted(): void
    {
        static::deleting(function (Post $post) {
            $post->attachments->each->delete();
        });
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
