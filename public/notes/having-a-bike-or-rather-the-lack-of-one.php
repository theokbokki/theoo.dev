<?php

require_once __DIR__.'../../../src/Parsedown.php';
require_once __DIR__.'../../../src/ParsedownExtra.php';
require_once __DIR__.'../../../src/Helpers.php';

$content = (new ParsedownExtra())->text(<<<NOTE
I would love to have a bike, to be precise, a cargo-bike. I live in a flat city and having a fast and easy way to do my groceries and move around would be nice.

But here's the thing, I live in a flat, on the fourth floor of a somewhat old building that doesn't have an elevator. The corridor is already taken by neighbours' bikes or stuff from the restaurant at the bottom floor and I don't have access to a basement.

Because of that, I do everything by foot. And that is slow. Well to be fair I walk fast, but a bike would be much faster. And I think that's also what's good about walking. Since it is slow, you have the time to enjoy your surroundings. I'm often stopping to watch dogs play, or bees going from flower to flower. Sometimes people stop you to ask their way around or so you can take a picture of them and their SO. It allows for situations you hadn't planned, like grabbing a coffee on your way because your favourite coffee shop is open late today, or finding a random street and ending up exploring a neighbourhood you didn't know about.  
I also often get ideas of stuff to write or sites to code when walking. Unlike on a bike, you don't have to pay as much attention at where you are going and your mind can wander more freely.

Now that I think about it, even if I had a bike, I might not use it. I like walking too much, I'm too used to it. I would find excuses, exactly like I do currently with the tram, "ah 2 minutes to wait, might as well walk there" or "mhh there will be too many people at this time of the day, it's sunny outside". So maybe I don't want a bike after all.
NOTE);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="57x57" href="/assets/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/assets/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/assets/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/assets/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/assets/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/assets/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/assets/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/assets/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/assets/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/assets/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicons/favicon-16x16.png">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/assets/favicons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <title>Having a bike or rather, the lack of one</title>
        <meta name="description" content="Talking about my desire to get a bike and the fact that I probably wouldn't use is." />

        <link rel="stylesheet" href="/assets/css/app.css">
        <script type="module" src="/assets/js/app.js"></script>
    </head>
    <body class="app app--<?= getTheme() ?>">
        <header>
            <canvas id="pets-canvas" class="center" aria-hidden="true"></canvas>
            <h1 class="center">Having a bike or rather, the lack of one</h1>
            <hr>
            <a href="/" class="center">← Back to Homepage</a>
        </header>
        <hr>
        <div>
            <?= $content ?>
        </div>
        <hr>
        <footer>
            <a href="#">↑ Back to top</a> 
        </footer>
    </body>
</html>
