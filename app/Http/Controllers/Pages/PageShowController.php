<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageShowController extends Controller
{
    public function __invoke(?string $path = null)
    {
        $page = Page::where('path', $path ?? '')->firstOrFail();

        return view('pages.show', [
            'page' => $page,
            'children' => $page->children()->orderBy('title'),
        ]);
    }
}
