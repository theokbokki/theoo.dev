<?php

namespace App\Enums;

enum NoteStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
}
