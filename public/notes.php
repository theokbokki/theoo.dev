<?php

require __DIR__.'/../vendor/autoload.php';

use Theoo\Content\Notes;

$title = 'Notes';

$cat = getCat();
$headerImg = getHeaderImage($cat);

$notes = Notes::get();

$name = $_GET['name'] ?? null;

if (isset($name) && preg_match('/[a-zA-Z0-9._-]/', $name)) {
    $item = array_filter($notes, function($item) use ($name) {
        return isset($item->src) && $item->src === $name;
    });
    
    $item = reset($item);

    if ($item) {
        $title = $item->name;
        $note = parseMd($item->src);
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
            <?php if(isset($note)): ?>
                <?= $note ?>
            <?php else: ?>
                <p>This is the place where I write about anything that goes on through my mind, you might find some useful or intersting things in there, but mostly talking to myself.</p>
            <?php endif; ?> 
            <hr>
            <ul>
                <?php foreach($notes as $note): ?>
                    <li>
                        <a href="/notes.php?name=<?= $note->src ?>">
                            <?= $note->name ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </main>
    </body>
</html>
