<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Picture;

class GalleryIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $pictures = Picture::latest()->get();

        return view('gallery.index', ['pictures' => $pictures]);
    }
}
