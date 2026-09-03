<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotesCreateController extends Controller
{
    public function __invoke(Request $request)
    {
        Storage::disk('public')->put('/notes/notes/untitled.md', "# Untitled");

        return redirect(route('notes.edit', ['slug' => 'untitled']));
    }
}
