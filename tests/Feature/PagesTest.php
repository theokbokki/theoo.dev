<?php

use function Pest\Laravel\get;

test('homepage loads correctly in English', function () {
    test()->refreshApplicationWithLocale('en');

    get(route('home'))
        ->assertOk()
        ->assertSee('I craft cool experiences for people on the internet');
});

test('homepage loads correctly in French', function () {
    test()->refreshApplicationWithLocale('fr');

    get(route('home'))
        ->assertOk()
        ->assertSee('Je crée des expériences uniques pour les gens sur internet');
});
