<?php

namespace App\Hiker\Resources\Trinkets\Attributes;

use Hiker\Components\Image\Image;
use Hiker\Structures\Archive\Attribute;
use Illuminate\Support\Facades\Storage;

class Src extends Attribute
{
    public $key = 'src';

    public bool $orderable = false;

    public function title()
    {
        return 'Src';
    }

    public function component($resource)
    {
        $path = Storage::disk('public')->url($resource->src);

        return Image::make($path)->aspectRatio('1/1');
    }
}
