<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Phiki\CommonMark\PhikiExtension;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('home', [
            'content' => $this->getContent(),
        ]);
    }

    private function getContent(): string
    {
        $filePath = 'notes/home.md';

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
