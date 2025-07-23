<?php

use League\CommonMark\CommonMarkConverter;

function asset(string $name): string
{
    static $manifest = null;

    if ($manifest === null) {
        $content = file_get_contents(__DIR__.'/../public/manifest.json');
        $manifest = json_decode($content, true);
    }

    if (isset($manifest[$name])) {
        return '/'.$manifest[$name];
    }

    return '/assets/'.$name;
}

function getHeaderImage(): object
{
    $headerImgs = [
        [
            'src' => asset('matcha.webp'),
            'alt' => 'The head of Matcha, my tabby cat, yawning big time.',
        ],
        [
            'src' => asset('tsuki.webp'),
            'alt' => 'The head of Tsuki, my tuxedo cat, roaring at me angrily.',
        ],
    ];

    return (object) $headerImgs[array_rand($headerImgs)];
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

function parseMd(string $name): string
{
    $converter = new CommonMarkConverter();
    $content = file_get_contents(__DIR__.'/../public/'.asset($name));

    return $converter->convert($content);
}
