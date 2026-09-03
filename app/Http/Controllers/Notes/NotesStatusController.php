<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class NotesStatusController extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        if (str_starts_with($slug, '-')) {
            File::move(
                Storage::disk('public')->path('notes/notes/'.$slug.'.md'),
                Storage::disk('public')->path('notes/notes/'.ltrim($slug, '-').'.md'),
            );

            return redirect(route('notes.show', ['slug' => ltrim($slug, '-')]));
        }

        File::move(
            Storage::disk('public')->path('notes/notes/'.$slug.'.md'),
            Storage::disk('public')->path('notes/notes/-'.$slug.'.md'),
        );

        return redirect(route('notes.show', ['slug' => '-'.$slug]));
    }
}
