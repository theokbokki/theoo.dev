<?php

namespace App\Http\Controllers\Links;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LinkTag;
use App\Models\Link;

class LinksTagController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $tag)
    {
        $links = Link::query()->whereRelation('tags', 'slug', $tag)->get();
        $tag = LinkTag::findBySlug($tag);
        $tags = LinkTag::all();


        return view('links.index', [
            'tags' => $tags,
            'tag' => $tag,
            'links' => $links,
        ]);
    }
}
