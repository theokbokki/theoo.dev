<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $oldDbPath = database_path('feed.sqlite');

        if (! file_exists($oldDbPath)) {
            $this->command->warn("Old database not found at {$oldDbPath} — skipping PostSeeder.");
            return;
        }

        config(['database.connections.old_sqlite' => [
            'driver'                  => 'sqlite',
            'database'                => $oldDbPath,
            'prefix'                  => '',
            'foreign_key_constraints' => false,
        ]]);

        $posts = DB::connection('old_sqlite')->table('posts')->orderBy('id')->get()->map(fn ($p) => [
            'id'         => $p->id,
            'content'    => $p->content,
            'created_at' => $p->created_at,
            'updated_at' => $p->updated_at,
        ])->all();

        if ($posts) {
            DB::table('posts')->insert($posts);
        }

        $this->command->info('Imported ' . count($posts) . ' posts from old database.');
    }
}
