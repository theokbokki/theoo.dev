<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PostsSeeder extends Seeder
{
    public function run(): void
    {
        $posts = json_decode(File::get(database_path('seeders/data/posts.json')), true);

        Post::query()->upsert($posts, uniqueBy: ['id'], update: ['content', 'created_at', 'updated_at']);
    }
}
