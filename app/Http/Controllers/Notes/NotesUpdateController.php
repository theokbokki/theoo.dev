<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesUpdateController extends Controller
{
    public function __invoke(Request $request, Note $note)
    {
        $validated = $request->validate([
            'title' => ['required'],
            'subtitle' => ['nullable'],
            'content' => ['required'],
        ]);

        $note->update([
            'slug' => str()->slug($validated['title']),
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'content' => $validated['content'],
        ]);

        return redirect(route('notes.show', ['note' => $note]));
    }
}
