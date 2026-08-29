<?php

namespace Modules\Notes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Tempest\Markdown\Markdown;

class NotesIndexController
{
    public function __invoke(Request $request)
    {
        return view('notes::index', ['notes' => $this->notes()]);
    }

    protected function notes()
    {
        $markdown = new Markdown();

        return array_map(function ($note) use ($markdown) {
            $title = $markdown->parse(Storage::disk('public')->get($note))->frontmatter['title'];

            return (object) [
                'title' => $title,
                'url' => route('notes.single', ['slug' => str()->slug($title)]),
            ];
        }, Storage::disk('public')->allFiles('notes'));
    }
}
