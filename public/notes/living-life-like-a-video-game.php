<?php

require_once __DIR__.'../../../src/Parsedown.php';
require_once __DIR__.'../../../src/ParsedownExtra.php';
require_once __DIR__.'../../../src/Helpers.php';

$content = (new ParsedownExtra())->text(<<<NOTE
A couple weeks ago, I went on an adventure. I used to do go on adventures all the time as a teenager, but I don't get around to doing it as much these days, work and responsibilities got in the way. (Though getting a dog will maybe get me to do more).

What I call an adventure, is basically living your life like you're in some fun open world video game. You get out of your house with your stuff in your backpack and you start walking in whatever direction. Eventually, you spot something in the distance, or a street you've never gone through or a building entrance you feel like could become a shortcut if it turns out there is also a door on the other side and you go for it. Then on the way, you will most likely spot something else interesting, and that's where things get fun for real. Because you can either bookmark this thing in a corner of your head (or a note on your phone or whatever) or you can switch directions and go for that new thing instead.

Generally, as you go from point of interest to point of interest, you end up in some random place, late and it's time to get home. On your way, you've probably spoken to a bunch of random people, had some type of sugary treat in a shop you didn't know about, picked up a cool rock or seen some nice birds.

I think this is a great way to experience life and to discover more things about the area that you live in. This is especially fun to do in a city (even better if it's one you don't know much) or in the woods. Here are some of my tips for a great adventure:

- PRIVATE often doesn't mean that much private. A lot of people are cool with you passing by when you explain what you are doing, and those who aren't ok will generally tell you off once they've checked you didn't steal anything.
- Give yourself an hour by which you should be back home and only walk for half of that time. The other half is used to come back! Trust me, you don't want to be trekking in some random woods 10km away from your home at night with no phone battery and your girlfriend waiting home. That doesn't end well.
- Be prepared for dead ends and going back on your steps a bunch. Not all roads lead to where you want and sometimes you take a wrong turn that leads nowhere and you have to walk half an hour back. That's just how it goes.
- Embrace opportunities and expect people to be nice. Especially in more remote places, people will be wondering what you are doing there and ask you about it. Explain your adventure and sometimes they might give you more stuff or they might even tell you about a new point of interest you should check out. Life is surprisingly like a video game when you live it like one.
- Bring ample amounts of water. It sucks to walk in the sun with nothing to drink and sometimes there is nowhere you can ask to refill your bottle.
- Treat yourself. If you see something you'd like to do or eat/drink and you can afford it, don't hesitate! Go for it and enjoy a nice moment in your adventure. Don't worry about the time, it's ok to have to go back home before you got to where you wanted.
- Everything is a path, you don't have to follow roads, cutting through woods or weird parking lots is fun and rarely that dangerous.
- Any means of transport is fine. If you feel like you live in a city you know like the back of your hand, well first, you don't, and second, you can take a train or a bus or your car to go somewhere else and start your adventure there instead! The adventure might even be getting back home from where the train/bus dropped you using your legs. Buses are also a real cheat code to be able to walk further since they make the "getting home" part much faster and can be found pretty much anywhere.

I hope this text could inspire you to try to go on an adventure as well, it doesn't have to be long, walking for an hour can already take you quite far!

If you do try (or maybe you already do this on a regular basis), I would be pleased to hear about fun stuff that happened during your adventures! You can email me at [hello@theoo.dev](mailto:hello@theoo.dev).
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

        <title>Living life like a video game</title>
        <meta name="description" content="A post about going on adventures like if your life was some sort of cool open world game." />

        <link rel="stylesheet" href="/assets/css/app.css">
        <script type="module" src="/assets/js/app.js"></script>
    </head>
    <body class="app app--<?= getTheme() ?>">
        <header>
            <canvas id="pets-canvas" class="center" aria-hidden="true"></canvas>
            <h1 class="center">Living life like a video game</h1>
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
