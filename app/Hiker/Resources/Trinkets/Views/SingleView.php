<?php

namespace App\Hiker\Resources\Trinkets\Views;

use App\Enums\TrinketType;
use Hiker\Components\Badge\Badge;
use Hiker\Components\Text\Text;
use Hiker\Components\Badge\Modifiers\BadgeStyle;
use Hiker\Components\Btn\Btn;
use Hiker\Components\Header\Header;
use Hiker\Components\Image\Image;
use Hiker\Components\Layouts\Layout;
use Hiker\Nodes\ResourceTemplate;
use Hiker\Tracks\Trips\Trip;
use Illuminate\Support\Facades\Storage;

class SingleView extends ResourceTemplate
{
    /**
     * Return the tab label
     */
    public function label(): string
    {
        return 'Trinket';
    }

    /**
     * Return the template's components
     */
    public function components(Trip $trip): array
    {
        return [
            Layout::make([
                Header::make()
                    ->title($this->label())
                    ->actions($this->actions())
                    ->extras($this->extras()),

                Text::make($this->resource->alt),

                Image::make(Storage::disk('public')->url($this->resource->src)),
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
        return [
            Badge::make()
                ->label($this->resource->type->label())
                ->style(BadgeStyle::Small),
        ];
    }
}
