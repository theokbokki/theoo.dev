<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Guarded([])]
class Attachment extends Model
{
    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }
}
