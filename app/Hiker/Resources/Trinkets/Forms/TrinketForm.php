<?php

namespace App\Hiker\Resources\Trinkets\Forms;

use App\Enums\TrinketType;
use Hiker\Components\Editor\Step;
use Hiker\Components\Fields\Image\Image;
use Hiker\Components\Fields\Select\Select;
use Hiker\Components\Fields\Text\Text;
use Hiker\Nodes\Form;
use Hiker\Tracks\Baggage;
use Illuminate\Support\Facades\Storage;

class TrinketForm extends Form
{
    /**
     * Get the form's subject line
     *
     * @return string
     */
    public function subject()
    {
        if ($this->trip->roadmap()->flow === 'draft') {
            return 'Create trinket';
        }

        return 'Edit trinket';
    }

    /**
     * Get the form's steps
     *
     * @return array
     */
    public function steps(Baggage $bag)
    {
        return [
            Step::make($this->subject(), 'general')
                ->fields([
                    Image::make('Image', 'src')
                        ->disk('public')
                        ->path('trinkets')
                        ->rules('required')
                        ->intervention(function ($image) {
                            $image->backup();

                            Storage::disk('public')->makeDirectory('trinkets');

                            $image->fit(1040, 1040, fn ($c) => $c->upsize());

                            $encoded = (string) $image->encode('webp', 75);

                            $filepath = 'trinkets/'.$image->filename.'.webp';

                            $this->trip->baggage()->setAttribute('webp', $filepath);

                            Storage::disk('public')->put($filepath, $encoded);

                            $image->reset();
                        }),

                    Text::make('Alt', 'alt')
                        ->rules(['required']),

                    Select::make('Type', 'type')
                        ->options($this->typeOptions())
                        ->rules(['required']),
                ]),
        ];
    }

    public function typeOptions(): array
    {
        return array_column(array_map(
            fn ($case) => ['value' => $case->value, 'label' => $case->label()],
            TrinketType::cases()
        ), 'label', 'value');
    }
}
