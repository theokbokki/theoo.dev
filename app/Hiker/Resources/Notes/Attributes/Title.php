<?php

namespace App\Hiker\Resources\Notes\Attributes;

use Hiker\Components\Text\Text;
use Hiker\Structures\Archive\Attribute;

class Title extends Attribute
{
    public $key = 'title';

    public function title()
    {
        return 'Title';
    }

    public function component($resource)
    {
        return Text::make($resource->title ?? null);
    }

    public function orderQuery($query, $direction)
    {
        return $query->orderBy('title', $direction);
    }
}
