<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesEditController extends Controller
{
    public function __invoke(Request $request, Note $note)
    {
        return view('notes.edit', ['note' => $note]);
    }
}
