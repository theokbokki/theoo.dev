<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinksDeleteController extends Controller
{
    public function __invoke(Request $request, Link $link)
    {
        $link->delete();

        return redirect(route('links.index'));
    }
}
