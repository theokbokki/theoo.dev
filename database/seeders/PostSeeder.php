<?php

namespace Database\Seeders;

use App\Enums\PostType;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(app()->isLocal()) {
            Post::factory()->count(5)->create([
                'type' => PostType::PROJECT,
            ]);

            Post::factory()->count(5)->create([
                'type' => PostType::ARTICLE,
            ]);
        }

        if(app()->isProduction()) {
            Post::query()->updateOrCreate(
                [
                    'slug' => [
                        'en' => str()->slug('Neovim config for Laravel development'),
                        'fr' => str()->slug('Configurer Neovim pour faire du Laravel'),
                    ],
                ],
                [
                    'title' => [
                        'en' => 'Neovim for Laravel',
                        'fr' => 'Neovim pour Laravel',
                    ],
                    'excerpt' => [
                        'en' => 'Turning neovim into a full fledged IDE',
                        'fr' => 'Transformer neovim en un IDE complet',
                    ],
                    'type' => PostType::ARTICLE,
                    'published_at' => null,
                ]
            );
        }
    }
}
