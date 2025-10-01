<?php

require_once __DIR__.'../../../src/Parsedown.php';
require_once __DIR__.'../../../src/ParsedownExtra.php';
require_once __DIR__.'../../../src/Helpers.php';

$content = (new ParsedownExtra())->text(<<<NOTE
You might have noticed that there are absolutely no dates on this website. And that is because I have a real problem with them.  

I think this started with Youtube, I've always felt that since there is so much content constantly appearing, I shouldn't look at older videos. And this might be a valid point, because if I had to catch up with every video of every channel I like, I would never find time to watch the newer ones.
But the problem is that I set my expiration date really early. Once a video is like a month old, it becomes pretty much unwatchable to me (Unless it's something I REALLY want to watch). And this attitude has grown to most of my internet usage.

I don't think it's a good thing. Stuff shouldn't feel expired (to me) just because it isn't the newest. So a while back, when I was still watching a lot of content on Youtube, (I've been pretty much using no social media for a couple months now, but more about it in another post), I added an addon that removed all dates from the interface. And all a sudden, I was watching older videos with no problem at all, simply because I didn't know they were old.

And this is the same for everywhere on the web, I have a hard time reading old blog posts sometimes. Even if the content is super interesting, a part of me feels like _Yeah but this was written in 2005, you ain't got time for this, it's too old_. But I try to force myself anyway and I'm getting better at it :))

The thing about dates is that I only feel this way about them on the web, I do read old books or watch old movies/series with no problem.  
It's just that there is so much content on the web and we are always being bombarded with so much of it at the same time that my brain has had to find a way to cut through the noise. Maybe if the web was a calmer place, more organized and caring, I'd have a easier time strolling through old stuff[^1].

So this is why there are not dates on my website, because I can't cope with dates and I would feel like my content would be worthless after a couple weeks. If the dates aren't there, they can't rot, or at least, there is nothing reminding me of it.

[^1]: Though you do get the web you choose to see. It's been way less stressful since cutting down on Youtube, Twitter and the likes and replacing them by reading blogs of people I like and decide to go on by myself, not by an algorithm.
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

        <title>My problem with dates on the web</title>
        <meta name="description" content="A short article about how my brain works around dates on the web and why there are none on this website." />

        <link rel="stylesheet" href="/assets/css/app.css">
        <script type="module" src="/assets/js/app.js"></script>
    </head>
    <body class="app app--<?= getTheme() ?>">
        <header>
            <canvas id="pets-canvas" class="center" aria-hidden="true"></canvas>
            <h1 class="center">My problem with dates on the web</h1>
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
