<?php

namespace App\Http\Controllers;

use App\Traits\HasPosts;
use Illuminate\Contracts\View\View;

class HomeController
{
    use HasPosts;

    public function __invoke(): View
    {
        return view('home', [
            'articles' =>  $this->getPosts('article')
                ->sortByDesc('created_at')
                ->take(3),
            'projects' =>  $this->getPosts('project')
                ->sortByDesc('created_at')
                ->take(3),
        ]);
    }
}
