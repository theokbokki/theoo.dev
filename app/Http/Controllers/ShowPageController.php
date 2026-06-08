<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class ShowPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, ?Page $page = null)
    {
        $page ??= Page::findBySlug('');

        if (($page->draft || $page->private) && ! auth()->check()) {
            return redirect()->route('page.show', ['page' => Page::findBySlug('')]);
        }

        return view('page.show', [
            'page' => $page,
            'children' => $page->children()
                ->unless(auth()->check(), fn ($q) => $q->where('draft', false)->where('private', false))
                ->orderByDesc('pinned')
                ->orderBy('draft')
                ->orderByDesc('updated_at')
                ->get(),
        ]);
    }
}
