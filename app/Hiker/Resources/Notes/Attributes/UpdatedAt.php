<?php

namespace App\Hiker\Resources\Notes\Attributes;

use Hiker\Components\Text\Text;
use Hiker\Structures\Archive\Attribute;

class UpdatedAt extends Attribute
{
    public $key = 'updated_at';

    public function title()
    {
        return 'Updated At';
    }

    public function component($resource)
    {
        return Text::make($resource->updated_at->format('d/m/Y') ?? null);
    }

    public function orderQuery($query, $direction)
    {
        return $query->orderBy('updated_at', $direction);
    }
}
