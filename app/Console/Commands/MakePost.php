<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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

    private string $type;

    /** Execute the console command. */
    public function handle(): void
    {
        $this->type = $this->getType();

        foreach ($this->getLanguages() as $language) {
            info("Creating {$this->type} in {$language}");

            $this->createFile(
                $this->contentForm(),
                getLocaleForLanguage($language)
            );
        }
    }

    private function getType(): string
    {
        return select(
            label: 'What do you want to create?',
            options: [
                'article' => 'Article',
                'project' => 'Project',
            ],
            required: true,
        );
    }

    /** @return array<int, string> */
    private function getLanguages(): array
    {
        return multiselect(
            label: "What languages will the {$this->type} be in?",
            options: [
                'English',
                'French',
            ],
            default: ['English'],
            required: true
        );
    }

    /** @return mixed[] */
    private function contentForm(): array
    {
        return form()
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
    }

    /** @param array<int,mixed> $form */
    private function createFile(array $form, string $locale): void
    {
        $slug = str()->slug($form['title']);
        $filepath = storage_path("posts/{$this->type}s/{$locale}/{$slug}.md");

        $template = file_get_contents(storage_path('posts/post-stub.md'));
        $template = str_replace('{{title}}', $form['title'], $template);
        $template = str_replace('{{excerpt}}', $form['excerpt'], $template);
        $template = str_replace('{{created_at}}', now(), $template);

        file_put_contents($filepath, $template);
    }
}
