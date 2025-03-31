<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShadersController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('shaders');
    }
}
