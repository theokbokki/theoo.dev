<?php

require_once __DIR__.'../../src/Helpers.php';

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

        <title>Home</title>
        <meta name="description" content="" />

        <link rel="stylesheet" href="/assets/css/app.css">
        <script type="module" src="/assets/js/app.js"></script>
    </head>
    <body class="app app--<?= getTheme() ?>">
        <canvas id="pets-canvas" aria-hidden="true"></canvas>
        <h1 class="center">Theoo</h1>
        <p class="center">Welcome on my place on the internet! I mostly write stuff, but also like design, shaders and coding in general.</p>
        <hr>
        <p class="center">You can contact me at <a href="mailto:hello@theoo.dev">hello@theoo.dev</a></p>
        <hr>
        <h2>Notes</h2>
        <ul>
            <li>
                <a href="/notes/books-i-read.php"/>Books I read</a>
            </li>
        </ul>
    </body>
</html>
