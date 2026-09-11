<?php

namespace Database\Seeders;

use App\Enums\Notes\NoteStatus;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(Storage::disk('public')->files('notes/notes'))
            ->filter(fn(string $note) => str_ends_with($note, '.md'))
            ->map(fn(string $note) => Storage::disk('public')->path($note))
            ->map(function (string $note) {
                [$firstLine, $content] = array_pad(explode("\n", File::get($note), 2), 2, '');

                $note = Note::create([
                    'slug' => ltrim(pathinfo($note, PATHINFO_FILENAME), '-_'),
                    'title' => trim(ltrim($firstLine, '# ')),
                    'content' => $content,
                    'status' => str_starts_with(pathinfo($note, PATHINFO_FILENAME), '-')
                        ? NoteStatus::Draft
                        : NoteStatus::Published,
                    'updated_at' => Carbon::parse(File::lastModified($note)),
                    'created_at' => Carbon::parse(File::lastModified($note)),
                ]);
            });
    }
}
