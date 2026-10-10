<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LinksIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('links.index');
    }
}
