<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteSlugHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                'content' => $this->getContent($note),
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

    private function getContent(Note $note): string
    {
        $filePath = 'notes/'.$note->slug.'.md';

        if (! Storage::disk('local')->exists($filePath)) {
            return '';
        }

        return  Storage::disk('local')->get($filePath);
    }
}
