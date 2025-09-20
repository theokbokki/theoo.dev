<?php

require_once __DIR__.'../../../src/Parsedown.php';

$content = (new Parsedown())->text(<<<NOTE
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

        <title>Note title</title>
        <meta name="description" content="" />

        <link rel="stylesheet" href="/assets/css/app.css">
        <script type="module" src="/assets/js/app.js"></script>
    </head>
    <body class="app app--<?= getTheme() ?>">
        <header>
            <canvas id="pets-canvas" class="center" aria-hidden="true"></canvas>
            <h1 class="center">Note title</h1>
            <hr>
            <a href="/" class="center">← Back to Homepage</a>
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
