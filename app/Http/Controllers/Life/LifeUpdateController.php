<?php

namespace App\Http\Controllers\Life;

use App\Http\Controllers\Controller;
use App\Models\Life;
use Illuminate\Http\Request;

class LifeUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Life $life)
    {
        $validated = $request->validate(['content' => ['nullable', 'string']]);

        Life::update($validated);
    }
}
