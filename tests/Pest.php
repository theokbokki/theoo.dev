<?php

use App\Entities\Post;
use Illuminate\Support\Facades\File;

uses(Tests\TestCase::class)->in('Feature');

function createPost($type, $lang)
{
    $title = 'test-'.fake()->unique()->sentence();

    test()->artisan('make:post')
        ->expectsQuestion('What do you want to create?', $type)
        ->expectsQuestion('What languages will the article be in?', [$lang])
        ->expectsQuestion('Title:', $title)
        ->expectsQuestion('Excerpt:', fake()->unique()->sentence());

    return Post::find(
        str()->slug($title),
        $type,
        getLocaleForLanguage($lang)
    );
}

function deleteTestPosts()
{
    $files = collect(...[
        File::allFiles(storage_path('posts/articles')),
        File::allFiles(storage_path('posts/projects'))
    ]);

    $files->each(function (SplFileInfo $file) {
        if (str_starts_with($file->getFilename(), 'test-')) {
            File::delete($file->getPathname());
        }
    });
}
