<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $notes = Note::query()->published()->orderBy('updated_at')->get();

        return view('notes.index', [
            'notes' => $notes,
        ]);
    }
}
