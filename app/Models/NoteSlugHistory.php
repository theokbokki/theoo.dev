<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NoteSlugHistory extends Model
{
    protected $fillable = [
        'slug',
    ];

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }
}
