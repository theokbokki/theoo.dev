<?php

require __DIR__.'/../vendor/autoload.php';

$title = 'Home';

$cat = getCat();
$headerImg = getHeaderImage($cat);

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
        <script type="module" src="<?= asset('app.js') ?>"></script>
    </head>
    <body class="app app--<?= getTheme() ?>">
        <header class="header header--home">
            <h1 class="header__title">Théoo</h1>
            <div class="header__intro">
                <p>Welcome on my place on the internet!</p>
                <p>I mostly write stuff, but also like design, shaders and coding in general.</p>
            </div>
            <hr>
            <p class="header__contact">You can contact me at <a href="mailto:hello@theoo.dev">hello@theoo.dev</a></p>
        </header>
        <main>
            <hr>
            <section>
                <h2>NOTES</h2>
            </section>
        </main>
    </body>
</html>
