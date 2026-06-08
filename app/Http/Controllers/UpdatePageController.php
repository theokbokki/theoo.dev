<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdatePageController extends Controller
{
    public function __invoke(Request $request, int $id)
    {
        $page = Page::query()->find($id);

        if ($request->ajax()) {
            $validated = $request->validate([
                'content' => [
                    'nullable',
                    'present',
                    'string',
                ],
            ]);

            $page->update($validated);

            return response()->json([
                'html' => str()->markdown($page->content),
            ]);
        }

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                Rule::unique('pages')->ignore($page),
            ],
            'draft' => [
                'required',
                'boolean',
            ],
            'pinned' => [
                'required',
                'boolean',
            ],
            'private' => [
                'required',
                'boolean',
            ],
        ]);

        $page->update($validated);

        return redirect()->route('page.show', ['page' => $page]);
    }
}
