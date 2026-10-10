<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class LinksSeeder extends Seeder
{
    public function run(): void
    {
        $notes = json_decode(File::get(database_path('seeders/data/links.json')), true);

        foreach ($notes as $note) {
            Link::create($note);
        }
    }
}
