<?php

namespace App\Hiker\Resources\Links\Attributes;

use Hiker\Components\Text\Text;
use Hiker\Structures\Archive\Attribute;

class CreatedAt extends Attribute
{
    public $key = 'created_at';

    public function title()
    {
        return 'Created at';
    }

    public function component($resource)
    {
        return Text::make($resource->created_at ?? null);
    }

    public function orderQuery($query, $direction)
    {
        return $query->orderBy('created_at', $direction);
    }
}
