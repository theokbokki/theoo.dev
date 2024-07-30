<?php

namespace App\Http\Controllers;

class ProjectController
{
    public function __invoke(string $slug)
    {
        echo $slug;
    }
}
