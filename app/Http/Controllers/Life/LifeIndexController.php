<?php

namespace App\Http\Controllers\Life;

use App\Http\Controllers\Controller;
use App\Models\Life;
use Illuminate\Http\Request;

class LifeIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $life = Life::firstOrCreate([]);

        return view('life.index', ['life' => $life]);
    }
}
