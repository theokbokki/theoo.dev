<?php

namespace App\Hiker\Resources\Notes\Attributes;

use Hiker\Structures\Archive\Attribute;
use Hiker\Components\Badge\Badge;
use Hiker\Components\Badge\Modifiers\BadgeStyle;
use Hiker\Components\Badge\Modifiers\BadgeColor;

class Published extends Attribute
{
    public $key = 'published';

    public function title()
    {
        return 'Published';
    }

    public function component($resource)
    {
        if ($resource->published) {
            return Badge::make()
                ->label('Published')
                ->color(BadgeColor::Green)
                ->style(BadgeStyle::Small);
        }

        return Badge::make()
            ->label('Published')
            ->color(BadgeColor::Red)
            ->style(BadgeStyle::Small);
    }

    public function orderQuery($query, $direction)
    {
        return $query->orderBy('published', $direction);
    }
}
