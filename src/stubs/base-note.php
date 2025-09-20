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
    </head>
    <body class="app">
        <header>
            <h1>Note title</h1>
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
