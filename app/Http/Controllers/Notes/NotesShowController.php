<?php

namespace App\Http\Controllers\Notes;

use App\Enums\Notes\NoteStatus;
use App\Http\Controllers\Controller;
use App\Models\Note;
use DOMDocument;
use DOMNode;
use Illuminate\Http\Request;

class NotesShowController extends Controller
{
    public function __invoke(Request $request, Note $note)
    {
        if ($note->status === NoteStatus::Draft && !auth()->check()) {
            return abort(404);
        }

        $note->content = $this->parseContent($note->content);
        $note->status = $note->status === NoteStatus::Draft ? NoteStatus::Published : NoteStatus::Draft;

        return view('notes.show', ['note' => $note]);
    }

    protected function parseContent(string $content)
    {
        $content = substr($content, strpos($content, "\n") + 1);
        $html = str()->markdown($content);
        $doc = new DOMDocument();

        @$doc->loadHTML('<meta charset="utf-8">' . $html);

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
            if (!($src = $image->getAttribute('src')) || !str_contains($src, 'thumb')) {
                continue;
            }

            $full = str_replace('thumb', 'full', $src);
            $id = 'note-image-' . $i;
            $alt = $image->getAttribute('alt');

            $image->setAttribute('class', 'notes__thumbnail');

            $zoom = $doc->createElement('button');
            $zoom->setAttribute('type', 'button');
            $zoom->setAttribute('class', 'notes__zoom');
            $zoom->setAttribute('command', 'show-modal');
            $zoom->setAttribute('commandfor', $id);
            if ($alt !== '') {
                $zoom->setAttribute('aria-label', 'Zoom image : ' . $alt);
            }

            $dialog = $doc->createElement('dialog');
            $dialog->setAttribute('id', $id);
            $dialog->setAttribute('closedby', 'any');
            $dialog->setAttribute('class', 'notes__dialog');
            if ($alt !== '') {
                $dialog->setAttribute('aria-label', $alt);
            }

            $close = $doc->createElement('button');
            $close->setAttribute('type', 'button');
            $close->setAttribute('class', 'notes__close');
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
            $fullImg->setAttribute('class', 'notes__full');
            $fullImg->setAttribute('loading', 'lazy');

            $dialog->appendChild($close);
            $dialog->appendChild($fullImg);

            $target = $this->imageContainer($image);
            $target->parentNode->replaceChild($zoom, $target);
            $zoom->appendChild($image);

            $body?->appendChild($dialog);
        }
    }

    protected function imageContainer(DOMNode $image): DOMNode
    {
        $parent = $image->parentNode;

        if (strtolower($parent->nodeName) !== 'p') {
            return $image;
        }

        foreach ($parent->childNodes as $child) {
            if ($child === $image) {
                continue;
            }
            if ($child->nodeType === XML_TEXT_NODE && trim($child->textContent) === '') {
                continue;
            }
            return $image;
        }

        return $parent;
    }
}
