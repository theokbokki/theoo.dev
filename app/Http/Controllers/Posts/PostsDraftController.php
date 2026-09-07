<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsDraftController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('posts.draft');
    }
}
