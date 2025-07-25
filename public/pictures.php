<?php

require __DIR__.'/../vendor/autoload.php';

use Theoo\Content\Pictures;

$title = 'Pictures';

$headerImg = getHeaderImage();

$pictures = Pictures::get();

$name = $_GET['name'] ?? null;

if (isset($name) && preg_match('/[a-zA-Z0-9._-]/', $name)) {
    $src = $name;
    $alt = $pictures->$name ?? null;
    $title = 'Pictures • '.$name;
}
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
    <body class="app app--<?= getTheme() ?>">
        <header class="header">
            <h1 class="header__title"><?= $title ?></h1>
            <a href="/" class="header__link">
                <span class="sro"><?= $title ?></span>
                <img class="header__img" src="<?= $headerImg->src ?>" alt="<?= $headerImg->alt ?>">
            </a>
        </header>

        <main class="app__main">
            <?php if(isset($src) && isset($alt)): ?>
                <div class="overlay">
                    <figure class="overlay__fig">
                        <img src="<?= asset($src.'-2.webp') ?>" alt="<?= $alt ?>" class="overlay__img"/>
                        <figcaption class="overlay__caption"><?= $src ?>.webp</figcaption>
                    </figure>
                    <a href="/pictures.php#<?= $src ?>" class="overlay__link">Click anywhere to close</a>
                </div>
            <?php else: ?>
                <div class="prose">
                    <p>I don't take a lot of pictures and I don't really know why. I used to take pictures of just about everything and I enjoyed it very much—so I think I should do it again.<br>I have some trouble remembering my life especially what happened in recent years and taking pictures again will be an attempt at overcoming this.</p>
                    <hr>
                </div>
                <div class="grid">
                    <?php foreach($pictures as $src => $alt): ?>
                        <div class="picture grid__item" id="<?= $src ?>">
                            <figure class="picture__fig">
                                <img src="<?= asset($src.'-1.webp') ?>" alt="<?= $alt ?>" class="picture__img"/>
                                <figcaption class="picture__caption"><?= $src ?>.webp</figcaption>
                            </figure>
                            <a href="/pictures.php?name=<?= $src ?>" class="picture__link">
                                <span class="sro">View picture in large version</span>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>
    </body>
</html>
