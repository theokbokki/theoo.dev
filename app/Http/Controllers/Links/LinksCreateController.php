<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinksCreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'url' => ['required', 'url'],
            'description' => ['nullable'],
        ]);

        Link::create([
            ...$validated,
            'favicon' => Link::fetchFavicon($validated['url']),
        ]);

        return redirect(route('links.index'));
    }
}
