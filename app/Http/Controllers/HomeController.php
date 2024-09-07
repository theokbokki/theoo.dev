<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('home', [
            'projects' => Post::query()
                ->projects()
                ->published()
                ->orderByDesc('published_at')
                ->limit(3)
                ->get(),
            'articles' => Post::query()
                ->articles()
                ->published()
                ->orderByDesc('published_at')
                ->limit(3)
                ->get(),
        ]);
    }
}
