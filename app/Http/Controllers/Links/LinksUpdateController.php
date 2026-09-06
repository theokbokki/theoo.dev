<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinksUpdateController extends Controller
{
    public function __invoke(Request $request, Link $link)
    {
        $validated = $request->validate([
            'url' => ['required', 'url'],
            'description' => ['nullable'],
        ]);

        $link->update([
            ...$validated,
            'favicon' => $validated['url'] !== $link->url
                ? Link::fetchFavicon($validated['url'])
                : $link->favicon,
        ]);

        return redirect(route('links.index'));
    }
}
