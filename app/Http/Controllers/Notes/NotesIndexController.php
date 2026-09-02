<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Enums\Notes\NoteStatus;

class NotesIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $notes = collect(Storage::disk('public')->files('notes'))
            ->filter(fn (string $note) => str_ends_with($note, '.md') && !str_starts_with(pathinfo($note, PATHINFO_FILENAME), '_'))
            ->map(fn (string $note) => Storage::disk('public')->path($note))
            ->map(fn (string $note) => (object) [
                'title' => ltrim(fgets(fopen($note, 'r')), '# '),
                'slug' => pathinfo($note, PATHINFO_FILENAME),
                'status' => str_starts_with(pathinfo($note, PATHINFO_FILENAME),'-') ? NoteStatus::Draft : NoteStatus::Published,
                'updated_at' => Carbon::parse(File::lastModified($note)),
            ])
            ->sortByDesc(fn (object $note) => $note->updated_at)
            ->groupBy('status');

        return view('notes.index', ['notes' => $notes]);
    }
}
