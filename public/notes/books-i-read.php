<?php

require_once __DIR__.'../../../src/Parsedown.php';
require_once __DIR__.'../../../src/Helpers.php';

$content = (new Parsedown())->text(<<<NOTE
This page is a list of books I've read, and those I'm currently reading.  
Most books I read are in French and may not have been translated in English (or I couldn't find a translated edition) hence the French titles.  
I purposefuly don't include ratings or opinions, this is just a simple list.

Don't hesitate to [send me an email](mailto:hello@theoo.dev) if you have books to recommend :))

---

Book(s) I'm reading:

- The travelling cat chronicles — Hiro Arikawa

---

Books I read:  

2025
- Matcha Cofe on Monday — Michiko Aoyama
- _Petit manuel de résistance contemporaine_ — Cyril Dion
- _Vers la sobriété heureuse_ — Pierre Rabhi
- The Hidden Life of Trees — Peter Wohlleben
- The passengers on the Hankyu line — Hiro Arikawa 
- I am a cat — Natsume Sôseki
- Extinction: a radical history — Ashley Dawson
- _Comment habiter le monde?_ — Aurelien Barrau
- Before the coffee gets cold — Toshikazu Kawaguchi
- Tales from the cafe — Toshikazu Kawaguchi
- The little book of Ikigai — Ken Mogi
- _Je suis un chat d'Asie_ — Isabelle Genlis
NOTE);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="" />
        <link rel="shortcut icon" href="" />
        <link rel="apple-touch-icon" sizes="180x180" href="" />
        <link rel="manifest" href="" />

        <title>Books I Read</title>
        <meta name="description" content="" />

        <link rel="stylesheet" href="/assets/css/app.css">
    </head>
    <body class="app app--<?= getTheme() ?>">
        <header>
            <h1>Books I Read</h1>
            <a href="/">← Back to Homepage</a>
        </header>
        <hr>
        <div class="prose">
            <?= $content ?>
        </div>
        <hr>
        <footer>
            <a href="#">↑ Back to top</a> 
        </footer>
    </body>
</html>
