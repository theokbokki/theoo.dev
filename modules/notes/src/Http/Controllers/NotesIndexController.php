<?php

namespace Modules\Notes\Http\Controllers;

use Carbon\Carbon;
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

        return collect(Storage::disk('public')->files('notes'))
            ->filter(fn($note) => str_ends_with($note, '.md'))
            ->map(function ($note) use ($markdown) {
                $parsed = $markdown->parse(Storage::disk('public')->get($note));
                $title = $parsed->frontmatter['title'];

                return (object) [
                    'title' => $title,
                    'updated_at' => Carbon::parse($parsed->frontmatter['updated_at']),
                    'url' => route('notes.single', ['slug' => str()->slug($title)]),
                ];
            })
            ->sortByDesc(fn($note) => $note->updated_at)
            ->values()
            ->all();
    }
}
