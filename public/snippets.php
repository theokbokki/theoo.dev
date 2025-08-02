<?php

require __DIR__.'/../vendor/autoload.php';

use Theoo\Content\Snippets;

$title = 'Notes';

$cat = getCat();
$headerImg = getHeaderImage($cat);

$snippets = Snippets::get();

$name = $_GET['name'] ?? null;

if (isset($name) && preg_match('/[a-zA-Z0-9._-]/', $name)) {
    $item = array_filter($snippets, function($item) use ($name) {
        return isset($item->src) && $item->src === $name;
    });
    
    $item = reset($item);

    if ($item) {
        $title = $item->name;
        $snippet = parseMd($item->src);
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

        <main class="app__main prose">
            <?php if(isset($snippet)): ?>
                <?= $snippet ?>
            <?php else: ?>
                <p>Here are some code snippets that are useful to me. Maybe some will be useful to you as well :))</p>
            <?php endif; ?> 
            <hr>
            <ul>
                <?php foreach($snippets as $snippet): ?>
                    <li>
                        <a href="/snippets.php?name=<?= $snippet->src ?>">
                            <?= $snippet->name ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </main>
    </body>
</html>
