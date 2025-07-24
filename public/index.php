<?php

require __DIR__.'/../vendor/autoload.php';

$title = 'Home';

$headerImg = getHeaderImage();

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

        <main>
            <nav class="toc">
                <h2 class="toc__title">Table of contents</h2>
                <a href="/links.php" class="toc__link">Links</a>
                <a href="/notes.php" class="toc__link">Notes</a>
                <a href="/inventory.php" class="toc__link">Inventory</a>
                <a href="/shaders.php" class="toc__link">Shaders</a>
                <a href="/pictures.php" class="toc__link">Pictures</a>
                <a href="/snippets.php" class="toc__link">Snippets</a>
                <a href="/designs.php" class="toc__link">Designs</a>
            </nav>
        </main>
    </body>
</html>
