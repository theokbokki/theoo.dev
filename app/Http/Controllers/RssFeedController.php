<?php

namespace App\Http\Controllers;

use App\Models\Page;

class RssFeedController extends Controller
{
    public function __invoke()
    {
        $pages = Page::query()
            ->whereHas('parent', fn ($parent) => $parent->whereIn('slug', [
                'notes',
                'collections',
            ]))
            ->whereNot('draft', true)
            ->whereNot('private', true)
            ->orderByDesc('created_at')
            ->get();

        return response()->view('rss', [
            'pages' => $pages,
        ])
            ->header('Content-Type', 'text/xml');
    }
}
