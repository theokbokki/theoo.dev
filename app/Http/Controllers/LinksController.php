<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        return view('links', [
            'links' => Link::all(),
        ]);
    }
}
