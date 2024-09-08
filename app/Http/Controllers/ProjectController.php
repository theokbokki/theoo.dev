<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $slug)
    {
        $post = Post::query()
            ->where('slug->'.app()->getLocale(), $slug)
            ->first();

        if (!$post || !$post->published_at || $post->published_at > now()) {
            abort(404);
        }

        return view('project', [
            'project' => $post,
        ]);
    }
}
