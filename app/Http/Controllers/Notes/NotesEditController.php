<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotesEditController extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        $path = 'notes/'.$slug.'.md';
        $content = Storage::disk('public')->get($path);

        if (! $content) return abort(404);

        $title = ltrim(fgets(fopen(Storage::disk('public')->path($path), 'r')), '# ');

        $note = (object) [
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
        ];

        return view('notes.edit', ['note' => $note]);
    }
}
