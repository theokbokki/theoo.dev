<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteSlugHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Phiki\CommonMark\PhikiExtension;

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
                'notes' => Note::query()->published()->get(),
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

        $content = Storage::disk('local')->get($filePath);

        $html = str()->markdown($content, extensions: [
            new PhikiExtension('min-light'),
        ]);

        return preg_replace(
            '/<p>::no-indent<\/p>\s*<p>(.*?)<\/p>/s',
            '<p class="no-indent">$1</p>',
            $html
        );
    }
}
