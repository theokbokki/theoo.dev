<?php

namespace Database\Seeders;

use App\Enums\PostType;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DateTime;

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
        Post::query()->create([
            'title' => 'Test',
            'slug' => 'test',
            'excerpt' => 'just a test article',
            'type' => PostType::ARTICLE,
            'external' => null,
            'published_at' => now()->subMinute(2),
        ]);

        Post::factory()->count(20)->create([
            'type' => PostType::PROJECT,
        ]);

        Post::factory()->count(20)->create([
            'type' => PostType::ARTICLE,
        ]);
    }

    private function projects(): void
    {
        $this->makePost(
            [
                'en' => 'Bookmarks',
                'fr' => 'Bookmarks',
            ],
            [
                'en' => 'The place where I store and sort the stuff I find interesting',
                'fr' => 'L\'endroit ou je range et trie ce que je trouve intéressant',
            ],
            PostType::PROJECT,
            'https://bookmarks.theoo.dev',
            now()
        );

        $this->makePost(
            [
                'en' => 'Trinkets',
                'fr' => 'Trinkets',
            ],
            [
                'en' => 'A collection of real and digital stuff I find pretty',
                'fr' => 'Une collection de trucs, réels ou digitaux, que je trouve jolis.',
            ],
            PostType::PROJECT,
            'https://trinkets.theoo.dev',
            now()
        );

        $this->makePost(
            [
                'en' => 'Snippets',
                'fr' => 'Snippets',
            ],
            [
                'en' => 'All my snippets in a powerfully filterable interface',
                'fr' => 'Tous mes snippets dans une interface aux filtres avancés',
            ],
            PostType::PROJECT,
            'https://snippets.theoo.dev',
            now()
        );
    }

    private function articles(): void
    {
        $this->makePost(
            [
                'en' => 'Blade SFC',
                'fr' => 'Blade SFC',
            ],
            [
                'en' => 'Write Blade like you would Vue or Svelte',
                'fr' => 'Ecrivez en Blade comme en Vue ou en Svelte',
            ],
            PostType::ARTICLE,
            null,
            now()
        );
    }

    private function makePost(
        array $title,
        array $excerpt,
        PostType $type,
        ?string $external,
        ?DateTime $published_at,
    ): void {
        $post = Post::query()
            ->where('slug->en', str()->slug($title['en']))->first();

        Post::query()->updateOrCreate(
            [
                'slug->en' => str()->slug($title['en']),
                'slug->fr' => str()->slug($title['fr']),
            ],
            [
                'title' => [
                    'en' => $title['en'],
                    'fr' => $title['fr'],
                ],
                'excerpt' => [
                    'en' => $excerpt['en'],
                    'fr' => $excerpt['fr'],
                ],
                'type' => $type,
                'external' => $external,
                'published_at' => is_null($published_at) ? $published_at : $post?->published_at ?? $published_at,
            ]
        );
    }
}
