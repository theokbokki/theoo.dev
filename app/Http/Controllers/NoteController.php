<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Note $note)
    {
        if (! $note->published) {
            abort(404);
        }

        return view('note');
    }
}
