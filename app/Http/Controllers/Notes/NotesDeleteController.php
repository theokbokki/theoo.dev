<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesDeleteController extends Controller
{
    public function __invoke(Request $request, Note $note)
    {
        $note->delete();

        return redirect(route('notes.index'));
    }
}
