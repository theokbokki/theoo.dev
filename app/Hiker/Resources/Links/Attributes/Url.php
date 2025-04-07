<?php

namespace App\Hiker\Resources\Links\Attributes;

use Hiker\Components\Text\Text;
use Hiker\Structures\Archive\Attribute;

class Url extends Attribute
{
    public $key = 'url';

    public function title()
    {
        return 'Url';
    }

    public function component($resource)
    {
        return Text::make($resource->url ?? null);
    }

    public function orderQuery($query, $direction)
    {
        return $query->orderBy('url', $direction);
    }
}
