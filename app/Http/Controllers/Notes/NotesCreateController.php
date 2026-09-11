<?php

namespace App\Http\Controllers\Notes;

use App\Enums\Notes\NoteStatus;
use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesCreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate(['content' => ['required']]);

        $title = trim(ltrim(explode("\n", $validated['content'])[0], '# '));

        $note = Note::create([
            'slug' => str()->slug($title),
            'title' => $title,
            'content' => $validated['content'],
            'status' => NoteStatus::Draft,
        ]);

        return redirect(route('notes.edit', ['note' => $note]));
    }
}
