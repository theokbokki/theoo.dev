<?php

use Illuminate\Support\Facades\File;

test('an article can be created in one language', function () {
    $this->artisan('make:post')
        ->expectsQuestion('What do you want to create?', 'article')
        ->expectsQuestion('What languages will the article be in?', ['English'])
        ->expectsQuestion('Title:', 'Who lives in a pineapple under the sea?')
        ->expectsQuestion('Excerpt:', 'Spongebob Squarepants!');

    $filepath = storage_path("posts/articles/en/who-lives-in-a-pineapple-under-the-sea.md");

    expect($filepath)->toBeFile();

    $content = file_get_contents($filepath);
    $expectedContent = <<<EOT
        ---
        title: Who lives in a pineapple under the sea?
        excerpt: Spongebob Squarepants!
        created_at: %s
        published: false
        ---

        # Who lives in a pineapple under the sea?

        EOT;
    $expectedContent = sprintf($expectedContent, now());

    expect($content)->toEqual($expectedContent);

    File::delete($filepath);
});

test('an article can be created in multiple languages', function () {
    $this->artisan('make:post')
        ->expectsQuestion('What do you want to create?', 'article')
        ->expectsQuestion('What languages will the article be in?', ['English', 'French'])
        ->expectsQuestion('Title:', 'Who lives in a pineapple under the sea?')
        ->expectsQuestion('Excerpt:', 'Spongebob Squarepants!')
        ->expectsQuestion('Title:', 'Qui vit dans un ananas dans la mer?')
        ->expectsQuestion('Excerpt:', 'Bob l\'éponge carrée!');

    $filepath = storage_path("posts/articles/en/who-lives-in-a-pineapple-under-the-sea.md");

    expect($filepath)->toBeFile();

    $content = file_get_contents($filepath);
    $expectedContent = <<<EOT
        ---
        title: Who lives in a pineapple under the sea?
        excerpt: Spongebob Squarepants!
        created_at: %s
        published: false
        ---

        # Who lives in a pineapple under the sea?

        EOT;
    $expectedContent = sprintf($expectedContent, now());

    expect($content)->toEqual($expectedContent);

    File::delete($filepath);

    $filepath = storage_path("posts/articles/fr/qui-vit-dans-un-ananas-dans-la-mer.md");

    expect($filepath)->toBeFile();

    $content = file_get_contents($filepath);
    $expectedContent = <<<EOT
        ---
        title: Qui vit dans un ananas dans la mer?
        excerpt: Bob l'éponge carrée!
        created_at: %s
        published: false
        ---

        # Qui vit dans un ananas dans la mer?

        EOT;
    $expectedContent = sprintf($expectedContent, now());

    expect($content)->toEqual($expectedContent);

    File::delete($filepath);
});

test('a project can be created in one language', function () {
    $this->artisan('make:post')
        ->expectsQuestion('What do you want to create?', 'project')
        ->expectsQuestion('What languages will the project be in?', ['English'])
        ->expectsQuestion('Title:', 'What\'s new, Scooby-Doo?')
        ->expectsQuestion('Excerpt:', 'We\'re coming after you. You\'re gonna solve that mystery.');

    $filepath = storage_path("posts/projects/en/whats-new-scooby-doo.md");

    expect($filepath)->toBeFile();

    $content = file_get_contents($filepath);
    $expectedContent = <<<EOT
        ---
        title: What's new, Scooby-Doo?
        excerpt: We're coming after you. You're gonna solve that mystery.
        created_at: %s
        published: false
        ---

        # What's new, Scooby-Doo?

        EOT;
    $expectedContent = sprintf($expectedContent, now());

    expect($content)->toEqual($expectedContent);

    File::delete($filepath);
});

test('a project can be created in mulitple languages', function () {
    $this->artisan('make:post')
        ->expectsQuestion('What do you want to create?', 'project')
        ->expectsQuestion('What languages will the project be in?', ['English', 'French'])
        ->expectsQuestion('Title:', 'What\'s new, Scooby-Doo?')
        ->expectsQuestion('Excerpt:', 'We\'re coming after you. You\'re gonna solve that mystery.')
        ->expectsQuestion('Title:', 'Quoi d\'neuf Scooby-Doo ?')
        ->expectsQuestion('Excerpt:', 'Nous, on te suit partout. On va résoudre ce mystère.');

    $filepath = storage_path("posts/projects/en/whats-new-scooby-doo.md");

    expect($filepath)->toBeFile();

    $content = file_get_contents($filepath);
    $expectedContent = <<<EOT
        ---
        title: What's new, Scooby-Doo?
        excerpt: We're coming after you. You're gonna solve that mystery.
        created_at: %s
        published: false
        ---

        # What's new, Scooby-Doo?

        EOT;
    $expectedContent = sprintf($expectedContent, now());

    expect($content)->toEqual($expectedContent);

    File::delete($filepath);

    $filepath = storage_path("posts/projects/fr/quoi-dneuf-scooby-doo.md");

    expect($filepath)->toBeFile();

    $content = file_get_contents($filepath);
    $expectedContent = <<<EOT
        ---
        title: Quoi d'neuf Scooby-Doo ?
        excerpt: Nous, on te suit partout. On va résoudre ce mystère.
        created_at: %s
        published: false
        ---

        # Quoi d'neuf Scooby-Doo ?

        EOT;
    $expectedContent = sprintf($expectedContent, now());

    expect($content)->toEqual($expectedContent);

    File::delete($filepath);
});
