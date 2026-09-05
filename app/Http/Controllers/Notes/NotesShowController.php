<?php

namespace App\Http\Controllers\Notes;

use App\Enums\Notes\NoteStatus;
use App\Http\Controllers\Controller;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotesShowController extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        if (str_starts_with($slug, '_')) return abort(404);

        $note = Storage::disk('public')->get('notes/notes/'.$slug.'.md');

        if (! $note) return abort(404);

        $note = explode("\n", $note);
        $title = ltrim(array_shift($note), '# ');
        array_shift($note);
        $content = implode("\n", $note);

        $note = (object) [
            'slug' => $slug,
            'status' => str_starts_with($slug, '-') ? NoteStatus::Published : NoteStatus::Draft,
            'title' => $title,
            'content' => $this->parseContent($content),
        ];

        return view('notes.show', ['note' => $note]);
    }

    protected function parseContent(string $content)
    {
        $html = str()->markdown($content);
        $doc = new DOMDocument;

        @$doc->loadHTML('<meta charset="utf-8">'.$html);

        $this->images($doc);

        $output = $doc->saveHTML();
        $output = str_replace('<meta charset="utf-8">', '', $output);

        return trim($output);
    }

    protected function images(DOMDocument $doc): void
    {
        $images = iterator_to_array($doc->getElementsByTagName('img'));
        $body = $doc->getElementsByTagName('body')->item(0);

        foreach ($images as $i => $image) {
            if (! ($src = $image->getAttribute('src')) || ! str_contains($src, 'thumb')) {
                continue;
            }

            $full = str_replace('thumb', 'full', $src);
            $id = 'note-image-'.$i;
            $alt = $image->getAttribute('alt');

            $image->setAttribute('class', 'note__thumbnail');

            $zoom = $doc->createElement('button');
            $zoom->setAttribute('type', 'button');
            $zoom->setAttribute('class', 'note__zoom');
            $zoom->setAttribute('command', 'show-modal');
            $zoom->setAttribute('commandfor', $id);
            if ($alt !== '') {
                $zoom->setAttribute('aria-label', 'Zoom image : '.$alt);
            }

            $dialog = $doc->createElement('dialog');
            $dialog->setAttribute('id', $id);
            $dialog->setAttribute('closedby', 'any');
            $dialog->setAttribute('class', 'note__dialog');
            if ($alt !== '') {
                $dialog->setAttribute('aria-label', $alt);
            }

            $close = $doc->createElement('button');
            $close->setAttribute('type', 'button');
            $close->setAttribute('class', 'note__close');
            $close->setAttribute('command', 'close');
            $close->setAttribute('commandfor', $id);
            $close->setAttribute('autofocus', '');
            $close->setAttribute('aria-label', 'Close');

            $icon = $doc->createElement('span');
            $icon->setAttribute('aria-hidden', 'true');
            $icon->appendChild($doc->createTextNode('✕'));
            $close->appendChild($icon);

            $fullImg = $doc->createElement('img');
            $fullImg->setAttribute('src', $full);
            $fullImg->setAttribute('alt', $alt);
            $fullImg->setAttribute('class', 'note__full');
            $fullImg->setAttribute('loading', 'lazy');

            $dialog->appendChild($close);
            $dialog->appendChild($fullImg);

            $image->parentNode->replaceChild($zoom, $image);
            $zoom->appendChild($image);

            $body?->appendChild($dialog);
        }
    }
}
