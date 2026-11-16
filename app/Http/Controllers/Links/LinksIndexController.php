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
    public function __invoke(Request $request, ?string $tag = null)
    {
        $tags = LinkTag::all();

        $links = Link::query()
            ->when($tag, fn ($query) => $query->whereRelation('tags', 'slug', $tag))
            ->orderByDesc('created_at')
            ->get();

        return view('links.index', [
            'current' => $tag,
            'tags' => $tags,
            'links' => $links,
        ]);
    }
}
