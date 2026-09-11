<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $notes = Note::query()->orderByDesc('updated_at')->get()->groupBy('status');

        return view('notes.index', ['notes' => $notes]);
    }
}
