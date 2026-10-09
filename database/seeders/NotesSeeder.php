<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class NotesSeeder extends Seeder
{
    public function run(): void
    {
        $notes = json_decode(File::get(database_path('seeders/data/notes.json')), true);

        foreach ($notes as $note) {
            Note::updateOrCreate(['slug' => $note['slug']], $note);
        }
    }
}
