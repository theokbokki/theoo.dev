<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class StorePageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => [
                'required',
                'exists:pages,id',
            ],
            'title' => [
                'required',
                'string',
                'unique:pages',
            ],
        ]);

        $page = Page::query()->create($validated);

        return redirect()->route('page.show', ['page' => $page]);
    }
}
