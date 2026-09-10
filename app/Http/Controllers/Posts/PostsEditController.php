<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsEditController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }
}
