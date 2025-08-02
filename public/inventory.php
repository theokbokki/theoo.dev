<?php

require __DIR__.'/../vendor/autoload.php';

use Theoo\Content\Inventory;

$title = 'Inventory';

$cat = getCat();
$headerImg = getHeaderImage($cat);

$inventory = Inventory::get();

$name = $_GET['name'] ?? null;

if (isset($name) && preg_match('/[a-zA-Z0-9._-]/', $name)) {
    $item = array_filter($inventory, function($item) use ($name) {
        return isset($item->src) && $item->src === $name;
    });
    
    $item = reset($item);

    if ($item) {
        $title = $title.' • '.$item->name;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="<?= asset($cat.'_favicon-96x96.png') ?>" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="<?= asset($cat.'_favicon.svg') ?>" />
        <link rel="shortcut icon" href="<?= asset($cat.'_favicon.ico') ?>" />
        <link rel="apple-touch-icon" sizes="180x180" href="<?= asset($cat.'_apple-touch-icon.png') ?>" />
        <link rel="manifest" href="<?= asset($cat.'_site.webmanifest') ?>" />

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
            <?php if(isset($item) && $item): ?>
                <div class="overlay">
                    <figure class="overlay__fig">
                        <img src="<?= asset($item->src.'-2.webp') ?>" alt="<?= $item->alt ?>" class="overlay__img"/>
                        <figcaption class="overlay__caption"><?= $item->name ?></figcaption>
                    </figure>
                    <a href="/inventory.php#<?= $item->src ?>" class="overlay__link">Click anywhere to close</a>
                </div>
            <?php else: ?>
                <div class="prose">
                    <p>The place where I put pictures of stuff that I own and that I like. It's a bit like a digital inventory for my real life self.<br>Some of the stuff is consumable, so I might not have it anymore.</p>
                    <hr>
                </div>
                <div class="grid">
                    <?php foreach($inventory as $item): ?>
                        <div class="picture grid__item" id="<?= $item->src ?>">
                            <figure class="picture__fig">
                                <img src="<?= asset($item->src.'-1.webp') ?>" alt="<?= $item->alt ?>" class="picture__img"/>
                                <figcaption class="picture__caption"><?= $item->name ?></figcaption>
                            </figure>
                            <a href="/inventory.php?name=<?= $item->src ?>" class="picture__link">
                                <span class="sro">View picture in large version</span>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>
    </body>
</html>
