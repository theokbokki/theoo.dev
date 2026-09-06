<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LinksDraftController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('links.draft');
    }
}
