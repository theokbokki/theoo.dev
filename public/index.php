<?php

require __DIR__.'/../vendor/autoload.php';

$title = 'Home';

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

$headerImg = (object) $headerImgs[array_rand($headerImgs)];

$themes = [
    'red',
    'orange',
    'yellow',
    'green',
    'blue',
    'purple',
    'pink',
];

$theme = $themes[array_rand($themes)];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="<?= asset('favicon-96x96.png') ?>" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="<?= asset('favicon.svg') ?>" />
        <link rel="shortcut icon" href="<?= asset('favicon.ico') ?>" />
        <link rel="apple-touch-icon" sizes="180x180" href="<?= asset('apple-touch-icon.png') ?>" />
        <link rel="manifest" href="<?= asset('site.webmanifest') ?>" />

        <title>Théoo • <?= $title ?></title>
        <meta name="description" content="" />

        <link rel="stylesheet" href="<?= asset('app.css') ?>">
    </head>
    <body class="app app--<?= $theme ?>">
        <header class="header">
            <h1 class="header__title"><?= $title ?></h1>
            <a href="/" class="header__link">
                <span class="sro">Home</span>
                <img class="header__img" src="<?= $headerImg->src ?>" alt="<?= $headerImg->alt ?>">
            </a>
        </header>
    </body>
</html>
