<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

#[Guarded([])]
class Attachment extends Model
{
    protected static function booted(): void
    {
        static::deleting(function (Attachment $attachment) {
            Storage::disk('public')->delete([
                "posts/full/{$attachment->src}.webp",
                "posts/thumb/{$attachment->src}.webp",
            ]);
        });
    }

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }
}
