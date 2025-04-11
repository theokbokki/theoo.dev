<?php

namespace App\Hiker\Resources\Notes\Views;

use Hiker\Components\Badge\Badge;
use Hiker\Components\Badge\Modifiers\BadgeColor;
use Hiker\Components\Badge\Modifiers\BadgeStyle;
use Hiker\Components\Btn\Btn;
use Hiker\Components\Header\Header;
use Hiker\Components\Layouts\Layout;
use Hiker\Nodes\ResourceTemplate;
use Hiker\Tracks\Trips\Trip;

class SingleView extends ResourceTemplate
{
    /**
     * Return the tab label
     *
     * @return string
     */
    public function label()
    {
        return $this->resource->title;
    }

    /**
     * Return the template's components
     *
     * @return array
     */
    public function components(Trip $trip)
    {
        return [
            Layout::make([
                Header::make()
                    ->title($this->label())
                    ->actions($this->actions())
                    ->extras($this->extras()),
            ]),
        ];
    }

    private function actions(): array
    {
        return [
            Btn::make()
                ->title('Delete')
                ->icon('trash')
                ->flow($this->resource, 'delete'),

            Btn::make()
                ->label('Edit')
                ->icon('pencil')
                ->flow($this->resource, 'edit'),
        ];
    }

    private function extras(): array
    {
        $extras = [];

        $extras[] = $this->resource->published
            ? Badge::make()
                ->label('Published')
                ->color(BadgeColor::Green)
                ->style(BadgeStyle::Small)
            : Badge::make()
                ->label('Not published')
                ->color(BadgeColor::Red)
                ->style(BadgeStyle::Small);

        return $extras;
    }
}
