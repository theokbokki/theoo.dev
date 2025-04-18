<?php

namespace App\Hiker\Resources\Notes\Attributes;

use Hiker\Structures\Archive\Attribute;
use Hiker\Components\Badge\Badge;
use Hiker\Components\Badge\Modifiers\BadgeColor;
use Hiker\Components\Badge\Modifiers\BadgeStyle;

class IsSnippet extends Attribute
{
    public $key = 'is_snippet';

    public function title()
    {
        return 'Is snippet';
    }

    public function component($resource)
    {
        if ($resource->is_snippet) {
            return Badge::make()
                ->label('Snippet')
                ->color(BadgeColor::Purple)
                ->style(BadgeStyle::Small);
        }

        return Badge::make()
            ->label('Note')
            ->color(BadgeColor::Yellow)
            ->style(BadgeStyle::Small);
    }

    public function orderQuery($query, $direction)
    {
        return $query->orderBy('is_snippet', $direction);
    }
}
