<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteSlugHistory;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $slug)
    {
        $note = Note::query()->where('slug', $slug)->first();

        if ($note) {
            abort_unless($note->published, 404);

            return view('note', [
                'note' => $note,
                'sroTitle' => $this->sroTitle($note),
            ]);
        }

        $history = NoteSlugHistory::query()
            ->where('slug', $slug)
            ->with('note')
            ->first();

        if ($history) {
            return redirect()->route('note', $history->note?->slug, 301);
        }

        abort(404);
    }

    public function sroTitle(Note $note): string
    {
        return $note->is_snippet
            ? 'All my other snippets'
            : 'All my other notes';
    }
}
