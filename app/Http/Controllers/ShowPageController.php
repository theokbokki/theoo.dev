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

        return view('page.show', [
            'page' => $page,
        ]);
    }
}
