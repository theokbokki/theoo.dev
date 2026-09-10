<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsDeleteController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $post->delete();

        return redirect(route('posts.index'));
    }
}
