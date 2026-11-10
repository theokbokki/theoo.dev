<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

#[Fillable(['src'])]
class Picture extends Model
{
    protected static function booted(): void
    {
        static::deleted(function (Picture $picture) {
            Storage::disk('public')->delete([
                $picture->src,
                'gallery/thumbs/' . basename($picture->src),
            ]);
        });
    }

    protected function url(): Attribute
    {
        return Attribute::get(function () {
            Storage::disk('public')->url($this->src);
        });
    }

    protected function thumbUrl(): Attribute
    {
        return Attribute::get(function () {
            Storage::disk('public')->url('gallery/thumbs/' . basename($this->src));
        });
    }
}
