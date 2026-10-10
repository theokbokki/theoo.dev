<?php

namespace App\Models;

use App\Enums\LinkCategory;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded([])]
class Link extends Model
{
    protected function casts(): array
    {
        return [
            'category' => LinkCategory::class,
        ];
    }
}
