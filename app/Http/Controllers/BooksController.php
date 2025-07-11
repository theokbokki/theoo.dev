<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('books', []);
    }
}
