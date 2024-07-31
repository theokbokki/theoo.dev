<?php

use App\Entities\Post;

uses(Tests\TestCase::class)->in('Feature');

function createPost($type, $lang) {
    $title = fake()->unique()->sentence();

    test()->artisan('make:post')
        ->expectsQuestion('What do you want to create?', $type)
        ->expectsQuestion('What languages will the article be in?', [$lang])
        ->expectsQuestion('Title:', $title)
        ->expectsQuestion('Excerpt:', fake()->unique()->sentence());

    $locale = match ($lang) {
        'English' => 'en',
        'French' => 'fr',
    };

    return Post::find(str()->slug($title), $type, $locale);
}
