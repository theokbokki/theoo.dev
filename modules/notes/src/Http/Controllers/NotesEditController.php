<?php

namespace Modules\Notes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Tempest\Markdown\Markdown;
use Tempest\Markdown\ParsedMarkdown;

class NotesEditController
{
    public function __invoke(Request $request, string $slug)
    {
        return view('notes::edit', ['note' => $this->note($slug)]);
    }

    protected function note(string $slug): ParsedMarkdown
    {
        $markdown = new Markdown();

        $note = Storage::disk('public')->get('notes/' . $slug . '.md');

        return $markdown->parse($note);
    }
}
