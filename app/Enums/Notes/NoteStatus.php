<?php

namespace App\Enums\Notes;

enum NoteStatus: string
{
    case Draft = 'draft';
    case Published = 'published';

    public function label()
    {
        return match($this)
        {
            self::Draft => 'Make Draft',
            self::Published => 'Publish',
        };
    }
}
