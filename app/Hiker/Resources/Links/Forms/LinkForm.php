<?php

namespace App\Hiker\Resources\Links\Forms;

use Hiker\Components\Editor\Step;
use Hiker\Components\Fields\Text\Text;
use Hiker\Nodes\Form;
use Hiker\Tracks\Baggage;

class LinkForm extends Form
{
    /**
     * Get the form's subject line
     *
     * @return string
     */
    public function subject()
    {
        if ($this->trip->roadmap()->flow === 'draft') {
            return 'Create link';
        }

        return 'Edit link';
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
                    Text::make('Description', 'description')
                        ->rules(['required']),

                    Text::make('Url', 'url')
                        ->icon('link')
                        ->rules(['required', 'url', 'unique:links']),
                ]),
        ];
    }
}
