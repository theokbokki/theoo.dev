<?php

namespace App\Hiker\Resources\Notes\Forms;

use App\Rules\UniqueSlugAcrossNotes;
use Hiker\Components\Editor\Step;
use Hiker\Components\Fields\Checkbox\Checkbox;
use Hiker\Components\Fields\Text\Text;
use Hiker\Nodes\Form;
use Hiker\Tracks\Baggage;

class NoteForm extends Form
{
    /**
     * Get the form's subject line
     *
     * @return string
     */
    public function subject()
    {
        if ($this->trip->roadmap()->flow === 'draft') {
            return 'Create note';
        }

        return 'Edit note';
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
                    Text::make('Title', 'title')
                        ->rules(['required', new UniqueSlugAcrossNotes($this->trip->resource()?->id)]),

                    Checkbox::make('Published', 'published'),

                    Checkbox::make('Is snippet', 'is_snippet'),
                ]),
        ];
    }
}
