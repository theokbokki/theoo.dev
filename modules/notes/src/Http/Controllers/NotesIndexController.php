<?php

namespace Modules\Notes\Http\Controllers;

use Illuminate\Http\Request;

class NotesIndexController
{
    public function __invoke(Request $request)
    {
        return view('notes::index');
    }
}
