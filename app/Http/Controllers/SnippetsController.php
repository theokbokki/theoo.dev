<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class SnippetsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('notes', [
            'notes' => Note::query()->publishedSnippets()->get(),
        ]);
    }
}
