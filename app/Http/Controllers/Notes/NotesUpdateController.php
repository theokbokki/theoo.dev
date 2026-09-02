<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class NotesUpdateController extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        $validated = $request->validate(['content' => ['required']]);

        File::delete(Storage::disk('public')->path('notes/'.$slug.'.md'));

        $content = $validated['content'];
        $slug = explode("\n", $content);
        $slug = array_shift($slug);
        $slug = ltrim($slug, '# ');
        $slug = str()->slug($slug);

        Storage::disk('public')->put('/notes/'.$slug.'.md', $content);

        return redirect(route('notes.edit', ['slug' => $slug]));
    }
}
