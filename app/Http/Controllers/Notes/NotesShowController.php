<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotesShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $slug)
    {
        $note = Storage::disk('public')->get('notes/'.$slug.'.md');

        if (! $note) return abort(404);

        $note = explode("\n", $note);
        $title = ltrim(array_shift($note), '# ');
        array_shift($note);
        $content = str()->markdown(implode("\n", $note));


        $note = (object) [
            'title' => $title,
            'content' => $content,
        ];

        return view('notes.show', ['note' => $note]);
    }
}
