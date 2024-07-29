<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\form;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;
use function Laravel\Prompts\info;

class MakePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new article or project post.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $post = select(
            label: 'What do you want to create?',
            options: [
                'article' => 'Article',
                'project' => 'Project',
            ]
        );

        $languages = multiselect(
            label: "What languages will the {$post} be in?",
            options: [
                'English',
                'French',
            ],
            default: ['English'],
            required: true
        );

        foreach ($languages as $language) {
            info("Creating {$post} in {$language}");

            $form = form()
                ->text(
                    "Title:",
                    name: 'title',
                    required: true
                )
                ->text(
                    "Excerpt:",
                    name: 'excerpt',
                    required: true
                )
                ->submit();

            $locale = match ($language) {
                'English' => 'en',
                'French' => 'fr',
            };

            $date = date('Y-m-d');
            $slug = str()->slug($form['title']);
            $filepath = storage_path("posts/{$post}s/{$locale}/{$date}-{$slug}.md");

            $template = file_get_contents(storage_path('posts/post-stub.md'));
            $template = str_replace('{{title}}', $form['title'], $template);
            $template = str_replace('{{excerpt}}', $form['excerpt'], $template);
            $template = str_replace('{{created_at}}', $date, $template);

            file_put_contents($filepath, $template);
        }
    }
}
