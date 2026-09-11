<?php

namespace App\Models;

use App\Enums\Notes\NoteStatus;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\RouteKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Guarded([])]
#[RouteKey('slug')]
class Note extends Model
{
    use SoftDeletes;

    protected $casts = ['status' => NoteStatus::class];
}
