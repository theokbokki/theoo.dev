<?php

namespace App\Http\Controllers;

class ArticleController
{
    public function __invoke(string $slug)
    {
        echo $slug;
    }
}
