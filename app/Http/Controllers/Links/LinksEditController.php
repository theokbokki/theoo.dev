<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinksEditController extends Controller
{
    public function __invoke(Request $request, Link $link)
    {
        return view('links.edit', ['link' => $link]);
    }
}
