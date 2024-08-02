<?php

use function Pest\Laravel\get;

test('homepage loads correctly in English', function () {
    test()->refreshApplicationWithLocale('en');

    get(route('home'))
        ->assertOk()
        ->assertSeeText('I craft cool experiences for people on the internet');
});

test('homepage loads correctly in French', function () {
    test()->refreshApplicationWithLocale('fr');

    get(route('home'))
        ->assertOk()
        ->assertSeeText('Je crée des expériences uniques pour les gens sur internet');
});

test('the three latest articles are shown on the homepage', function () {
    test()->refreshApplicationWithLocale('en');

    $post1 = createPost('article', 'English')->publish();
    sleep(1);
    $post2 = createPost('article', 'English')->publish();
    sleep(1);
    $post3 = createPost('article', 'English')->publish();
    sleep(1);
    $post4 = createPost('article', 'English')->publish();

    get(route('home'))
        ->assertOk()
        ->assertSeeText($post2->title)
        ->assertSeeText($post2->excerpt)
        ->assertSeeText($post3->title)
        ->assertSeeText($post3->excerpt)
        ->assertSeeText($post4->title)
        ->assertSeeText($post4->excerpt);

    deleteTestPosts();
});

test('only articles in the same language are shown on the homepage', function () {
    test()->refreshApplicationWithLocale('en');

    $post1 = createPost('article', 'English')->publish();
    $post2 = createPost('article', 'English')->publish();
    $post3 = createPost('article', 'English')->publish();
    $post4 = createPost('article', 'French')->publish();

    get(route('home'))
        ->assertOk()
        ->assertSeeText($post1->title)
        ->assertSeeText($post1->excerpt)
        ->assertSeeText($post2->title)
        ->assertSeeText($post2->excerpt)
        ->assertSeeText($post3->title)
        ->assertSeeText($post3->excerpt)
        ->assertDontSeeText($post4->title)
        ->assertDontSeeText($post4->excerpt);

    deleteTestPosts();
});

test('only published articles are shown on the homepage', function () {
    test()->refreshApplicationWithLocale('en');

    $post1 = createPost('article', 'English')->publish();
    $post2 = createPost('article', 'English');

    get(route('home'))
        ->assertOk()
        ->assertSeeText($post1->title)
        ->assertSeeText($post1->excerpt)
        ->assertDontSeeText($post2->title)
        ->assertDontSeeText($post2->excerpt);

    deleteTestPosts();
});
