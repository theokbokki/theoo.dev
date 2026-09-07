<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttachmentSeeder extends Seeder
{
    public function run(): void
    {
        $oldDbPath = database_path('feed.sqlite');

        if (! file_exists($oldDbPath)) {
            $this->command->warn("Old database not found at {$oldDbPath} — skipping AttachmentSeeder.");
            return;
        }

        config(['database.connections.old_sqlite' => [
            'driver'                  => 'sqlite',
            'database'                => $oldDbPath,
            'prefix'                  => '',
            'foreign_key_constraints' => false,
        ]]);

        $attachments = DB::connection('old_sqlite')->table('attachments')->orderBy('id')->get()->map(fn ($a) => [
            'id'              => $a->id,
            'attachable_id'   => $a->post_id,
            'attachable_type' => Post::class,
            'src'             => $a->src,
            'created_at'      => now(),
            'updated_at'      => now(),
        ])->all();

        if ($attachments) {
            DB::table('attachments')->insert($attachments);
        }

        $this->command->info('Imported ' . count($attachments) . ' attachments from old database.');
    }
}
