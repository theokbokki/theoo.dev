<?php

use League\CommonMark\CommonMarkConverter;

function asset(string $name): string
{
    static $manifest = null;

    if ($manifest === null) {
        $content = file_get_contents(__DIR__.'/../public/assets/manifest.json');
        $manifest = json_decode($content, true);
    }

    if (isset($manifest[$name])) {
        return '/'.$manifest[$name];
    }
    
    return '/assets/'.$name;
}

function getCat(): string
{
    $cats = ['matcha', 'tsuki'];

    return $cats[array_rand($cats)];
}

function getHeaderImage(string $cat): object
{
    $headerImgs = [
        'matcha' => [
            'src' => asset('matcha.webp'),
            'alt' => 'The head of Matcha, my tabby cat, yawning big time.',
        ],
        'tsuki' => [
            'src' => asset('tsuki.webp'),
            'alt' => 'The head of Tsuki, my tuxedo cat, roaring at me angrily.',
        ],
    ];

    return (object) $headerImgs[$cat];
}

function getTheme(): string
{
    $themes = [
        'red',
        'orange',
        'yellow',
        'green',
        'blue',
        'purple',
        'pink',
    ];

    return $themes[array_rand($themes)];
}

function parseMd(string $name): ?string
{
    $path = __DIR__.'/../public'.asset($name.'.md');

    if (! file_exists($path)) {
        return null;
    }

    $converter = new CommonMarkConverter();
    $content = file_get_contents($path);

    return $converter->convert($content);
}
