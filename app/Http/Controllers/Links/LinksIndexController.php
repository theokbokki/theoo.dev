<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinksIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $linksByCategory = Link::query()
            ->orderByDesc('created_at')
            ->get()
            ->sortBy(fn (Link $link) => $link->category->getOrder())
            ->groupBy(fn (Link $link) => $link->category->getLabel());

        return view('links.index', ['linksByCategory' => $linksByCategory]);
    }
}
