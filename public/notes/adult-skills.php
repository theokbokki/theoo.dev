<?php

require_once __DIR__.'../../../src/Parsedown.php';
require_once __DIR__.'../../../src/ParsedownExtra.php';
require_once __DIR__.'../../../src/Helpers.php';

$content = (new ParsedownExtra())->text(<<<NOTE
I have been considered an adult for a few years now, that's to say I've had my own place away from my mother's for a while. And I've noticed something, there is a certain amount of things you aren't taught in pre-adult life, well maybe you were but I wasn't and I know many other people who weren't. Then at some point you become an adult to the world, and you eventually have to face these things. Generally, they aren't hard things, it's stuff like cleaning the shower drain, fixing a tripped circuit breaker, how long you can store food in the fridge, how to pay your taxes, should you drill in this wall or will you hit an electrical cable, how to get rid of stuff that doesn't fit in the trash,...  
And for some reason, you have to figure these out on your own. Sure, you can maybe call your family or a friend, you have access to the internet and these days, you can even ask AI. But still, why was I never taught these things? Why aren't we taught, be it by our parents (at least mine) or by school, the stuff that will be useful in our actual life? And I can't even say it's only something about nowadays society, when talking about it to older people, the general concensus is that they also had to figure it out on their own.

Maybe it's something inherently human, we have always relied on other humans for help, therefore there was never really a need to teach such things, you could always ask someone. Which would also explain why the stuff we are taught in school isn't the useful one but the rest. I couldn't have asked my mom or my neighbour to explain some weird Chemistry concept, they probably wouldn't have had a clue or just a rough idea. Because I don't really need a teacher to tell me how to clean my toilets in the correct way. Yet I can't help but shake the feeling that in a more and more isolated world[^1] we might not be able to rely on other people as much. Having to ask a neighbour for something is a hell of an effort, because I hardly know them, only from crossing in the hallways. Calling my family for help feels like a reach when I haven't seen them in months or barely for a couple hours [^2]. And sure there is internet and AI, and they have gotten me out of many situations before, but as useful as these tools are, it seems to me that they also are the primary cause of the lessening of human interactions.

So what should we do as humans? Should we teach useful life things in school instead of the more work-life/make money stuff we are taught? Should we try to rebuild links with our family, friends and neighbourhood? Maybe live together for longer like they used to do? Take care of one another more?  
I'm not sure of any of these though I have a pretty positive opinion on most of them. Maybe I'm wrong as well, and figuring these things out by yourself is not as much of a big deal as I make it out to be. After all, none of these things has ever taken me more than a couple hours to figure out.  
I don't know what I really think of all of this, and there are many topics addressed in this text that I would like to revisit later, but I think that for now I'm gonna try to have a more sociable life and talk more to other humans and less to the computer.

 [^1]: At least that's how I feel in my life. More isolated than the people before me, partially by my own fault.
 [^2]: Mostly a me problem this one, but I feel that modern life leaves you with little time to spare for yourself, therefore even less for family. I guess this depends on your values and priorities though.
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

        <title>Adult skills</title>
        <meta name="description" content="A note about growing up and my feelings on being isolated due to technology and nowadays mindset." />

        <link rel="stylesheet" href="/assets/css/app.css">
        <script type="module" src="/assets/js/app.js"></script>
    </head>
    <body class="app app--<?= getTheme() ?>">
        <header>
            <canvas id="pets-canvas" class="center" aria-hidden="true"></canvas>
            <h1 class="center">Adult skills</h1>
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
