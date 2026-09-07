<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('posts.index', [
            'posts' => Post::orderByDesc('created_at')->orderByDesc('id')->get()
        ]);
    }
}
