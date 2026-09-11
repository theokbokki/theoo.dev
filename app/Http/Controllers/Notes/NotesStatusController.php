<?php

namespace App\Http\Controllers\Notes;

use App\Enums\Notes\NoteStatus;
use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesStatusController extends Controller
{
    public function __invoke(Request $request, Note $note)
    {
        $note->update([
            'status' => $note->status === NoteStatus::Draft ? NoteStatus::Published : NoteStatus::Draft,
        ]);

        return redirect(route('notes.show', ['note' => $note]));
    }
}
