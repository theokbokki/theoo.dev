<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Note $note)
    {
        return view('notes.show', [
            'note' => $note,
        ]);
    }
}
