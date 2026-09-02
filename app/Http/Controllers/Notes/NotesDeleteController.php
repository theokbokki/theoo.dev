<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class NotesDeleteController extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        File::move(
            Storage::disk('public')->path('notes/'.$slug.'.md'),
            Storage::disk('public')->path('notes/_'.$slug.'.md'),
        );

        return redirect(route('notes.index'));
    }
}
