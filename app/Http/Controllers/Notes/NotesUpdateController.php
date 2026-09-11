<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesUpdateController extends Controller
{
    public function __invoke(Request $request, Note $note)
    {
        $validated = $request->validate(['content' => ['required']]);

        $title = trim(ltrim(explode("\n", $validated['content'])[0], '# '));

        $note->update([
            'slug' => str()->slug($title),
            'title' => $title,
            'content' => $validated['content'],
        ]);

        return redirect(route('notes.edit', ['note' => $note]));
    }
}
