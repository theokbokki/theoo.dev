<?php

namespace App\Http\Controllers;

use App\Models\Trinket;
use Illuminate\Http\Request;

class TrinketsController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('trinkets', [
            'groups' => Trinket::all()->groupBy('type'),
        ]);
    }
}
