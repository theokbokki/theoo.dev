<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinksIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('links.index', ['links' => Link::all()]);
    }
}
