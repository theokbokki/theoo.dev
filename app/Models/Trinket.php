<?php

namespace App\Models;

use App\Enums\TrinketType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trinket extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'src',
        'alt',
        'type',
    ];

    protected function casts(): array
    {
        return [
            'type' => TrinketType::class,
        ];
    }
}
