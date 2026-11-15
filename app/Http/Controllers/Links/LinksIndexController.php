<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\LinkTag;
use Illuminate\Http\Request;

class LinksIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $tags = LinkTag::all();
        $links = Link::query()->orderByDesc('created_at')->get();

        return view('links.index', [
            'tags' => $tags,
            'links' => $links,
        ]);
    }
}
