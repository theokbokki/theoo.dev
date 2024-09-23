<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('articles', [
            'articles' => Post::query()
                ->articles()
                ->published()
                ->orderByDesc('published_at')
                ->get(),
        ]);
    }
}
