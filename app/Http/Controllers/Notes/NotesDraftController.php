<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotesDraftController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('notes.draft');
    }
}
