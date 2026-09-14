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
        $validated = $request->validate([
            'title' => ['required'],
            'subtitle' => ['nullable'],
            'content' => ['required'],
        ]);

        $note = Note::query()->create([
            'slug' => str()->slug($validated['title']),
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'content' => $validated['content'],
            'status' => NoteStatus::Draft,
        ]);

        return redirect(route('notes.edit', ['note' => $note]));
    }
}
