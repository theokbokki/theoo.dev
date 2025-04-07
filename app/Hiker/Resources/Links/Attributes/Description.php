<?php

namespace App\Hiker\Resources\Links\Attributes;

use Hiker\Components\Text\Text;
use Hiker\Structures\Archive\Attribute;

class Description extends Attribute
{
    public $key = 'description';

    public function title()
    {
        return 'Description';
    }

    public function component($resource)
    {
        return Text::make($resource->description ?? null);
    }

    public function orderQuery($query, $direction)
    {
        return $query->orderBy('description', $direction);
    }
}
