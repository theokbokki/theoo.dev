<?php

namespace App\Hiker\Resources\Trinkets\Attributes;

use Hiker\Components\Badge\Badge;
use Hiker\Structures\Archive\Attribute;

class Type extends Attribute
{
    public $key = 'type';

    public function title()
    {
        return 'Type';
    }

    public function component($resource)
    {
        return Badge::make()->label($resource->type);
    }

    public function orderQuery($query, $direction)
    {
        return $query->orderBy('type', $direction);
    }
}
