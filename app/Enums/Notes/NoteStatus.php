<?php

namespace App\Enums\Notes;

enum NoteStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
}
