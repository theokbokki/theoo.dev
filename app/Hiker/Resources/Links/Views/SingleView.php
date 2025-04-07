<?php

namespace App\Hiker\Resources\Links\Views;

use Hiker\Components\Btn\Btn;
use Hiker\Components\Text\Text;
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
        return $this->resource->description;
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
                    ->actions([
                        Btn::make()
                            ->title('Delete')
                            ->icon('trash')
                            ->flow($this->resource, 'delete'),

                        Btn::make()
                            ->label('Edit')
                            ->icon('pencil')
                            ->flow($this->resource, 'edit'),
                    ])
                    ->extras([
                        Text::make($this->resource->url)
                    ]),
            ]),
        ];
    }
}
