<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

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

        File::ensureDirectoryExists(Storage::disk('public')->path('posts/full'));
        File::ensureDirectoryExists(Storage::disk('public')->path('posts/thumb'));
        $manager = ImageManager::usingDriver(Driver::class);

        $oldAttachments = DB::connection('old_sqlite')->table('attachments')->orderBy('id')->get();

        $rows = [];

        foreach ($oldAttachments as $a) {
            // Old src looks like "img/uuid.ext"; the original file lives in posts/attachments/uuid.ext.
            $original = Storage::disk('public')->path('posts/attachments/' . basename($a->src));
            $uuid = pathinfo($a->src, PATHINFO_FILENAME);

            if (! file_exists($original)) {
                $this->command->warn("Missing original for attachment {$a->id}: {$original} — skipping.");
                continue;
            }

            $image = $manager->decode($original);

            $image->scaleDown(width: 1440, height: 1440)
                ->save(Storage::disk('public')->path("posts/full/{$uuid}.webp"), quality: 85);

            $image->scaleDown(width: 640, height: 640)
                ->save(Storage::disk('public')->path("posts/thumb/{$uuid}.webp"), quality: 85);

            $rows[] = [
                'id'              => $a->id,
                'attachable_id'   => $a->post_id,
                'attachable_type' => Post::class,
                'src'             => $uuid,
                'created_at'      => now(),
                'updated_at'      => now(),
            ];
        }

        if ($rows) {
            DB::table('attachments')->insert($rows);
        }

        $this->command->info('Imported ' . count($rows) . ' attachments from old database.');
    }
}
