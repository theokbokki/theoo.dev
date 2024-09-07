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
            $this->test();
        }

        if(app()->isProduction()) {
            $this->articles();
            $this->projects();
        }
    }

    private function test(): void
    {
        Post::factory()->count(20)->create([
            'type' => PostType::PROJECT,
        ]);

        Post::factory()->count(20)->create([
            'type' => PostType::ARTICLE,
        ]);
    }

    private function projects(): void
    {}

    private function articles(): void
    {
        Post::query()->updateOrCreate(
            [
                'slug' => [
                    'en' => str()->slug('Neovim for Laravel'),
                    'fr' => str()->slug('Neovim pour Laravel'),
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
                'external' => false,
                'published_at' => now()->subDays(10),
            ]
        );
    }
}
