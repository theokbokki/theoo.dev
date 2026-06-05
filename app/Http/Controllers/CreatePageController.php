<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreatePageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $parentId)
    {
        return view('page.create', [
            'parentId' => $parentId,
        ]);
    }
}
