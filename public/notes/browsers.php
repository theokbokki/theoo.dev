<?php

require_once __DIR__.'../../../src/Parsedown.php';
require_once __DIR__.'../../../src/ParsedownExtra.php';
require_once __DIR__.'../../../src/Helpers.php';

$content = (new ParsedownExtra())->text(<<<NOTE
Since I was born in the early 2000s, I've been around browsers most of my life. The first one was Firefox, it was the one installed on the family computer and I didn't even know there were other browsers at the time. To be fair, there was no difference between the browser, the search engine and internet in my mind.  
Then I discovered Internet Explorer while trying to kill the time at my grandparents'. I would play random flash games and watch let's plays of Mario Kart Wii on Youtube. At some point, Chrome replaced Firefox on the home computer which had since become a laptop, and would even replace my grandparents' trusty IE. For many years after that, all that existed was Chrome, maybe Safari for the odd times where I used a Mac at school or at some Aunt's place, but I knew no better.

Somehow along the path of my life, I ended up studying web development, and that's when the problems started. Because you see, before that, a browser was just a box with tabs that allowed me to access the internet, nothing more, nothing less. But then it became a tool, and a very important one as well, I wanted it to look good since I would spend most of my days there, but also to be fast and support many features. So at first I downloaded the three main browsers, to be able to test my websites properly, Firefox, Chrome and Safari, and I started to have preferences.  
Safari was the sleek good looking one[^1], but so many websites would break when they encountered it and the dev tools sucked. Chrome was the web development beast, it didn't look too bad, its dev-tools were fantastic and it supported every feature under the sun, but it was run by Google... yuck. Firefox, was the ugly one, I hate how base Firefox looks, but at least Mozilla foundation felt less bad than Google or Apple and it supported most features with good enough dev-tools.  
I was torn, constantly switching between the three for different tasks, never feeling at home anywhere and I wanted it to stop. So I started looking online for alternatives, and there were many.

That's when my browser frenzy got started, at some point I had 22 different browsers installed on my computer. There were the minimal ones like Min, the featureful ones like Vivaldi, Opera or Orion, the plethora of privacy focused forks, LibreWolf, Mullvad Browser, Waterfox, Ungoogled chromium, Brave, Throium,... a bunch of Vim inspired ones like Vieb or Qutebrowser. I even tried to use terminal based browsers like Lynx or w3m[^2] but quickly gave up on these. I was never satisfied, always looking for a good balance between privacy, my love for the keyboard and good looks. And that's when a new name started to rise discreetly, Arc.

See, Arc definitely didn't tick the privacy nor the keyboard centric box, but it had such good looks[^3] that I couldn't keep looking away. I had it laying on my computer for about a year, using it on an off, never feeling quite at ease, but then it grew on me. At some point I had accepted that what mattered most to me was the way my browser looked[^4] and the ease with which I could use it to develop websites over the privacy aspect. And so I became a happy Arc user, there was little to complain about, after so many attempts and years of searching, I finally had found a browser that I would stick with in the long run. 
    
But then "The Browser Company" decided to stop working on Arc, and that sucked and this Arc breakup re-ignited my frenetic browser search. The novelty of Arc, with it's thursday updates had been able to keep my mind quiet, always having something new to try, but then I didn't have this safeguard anymore. So I went back to previous browsers I had really liked, Orion, LibreWolf and even Chrome... But the Arc way had poisoned my mind, not being able to open something in glance? No folders? No nice catchy animations absolutely everywhere? These had all become necessary things in my way of interacting with the internet.  
Fortunately, great folks decided to create [Zen](https://zen-browser.app/). This browser ticks most of these boxes _and_ it is also open source and more private. So I've been using it as my day to day browser for a while, but at the same time I'm still looking around for alternatives.  
The thing is, now that I'm not blinded by Arc anymore, I realize that I actually don't fancy the sidebar that much. It's alright, but I love the look of top tabs and the usability of them. And of course, Zen team has already said that they don't plan to support top tabs, ever. "The Browser Company"'s new browser, Dia, could have been a great replacement, but even if it ever reaches feature parity with Arc, I still don't trust "The Browser Company" anymore and I hate the AI and the monetary aspect of it.

So here I am, stuck in this browser landscape, with so many choices but none that perfectly fits me. Maybe it's time I accept that nothing will ever be perfect, and to be at peace with using a browser that is more than good enough. To stop losing time switching and setting up different apps over and over again. I think that's a lesson for my life in general, stop wanting to always change things up, and be satisfied by whatever I have as long as it works.

[^1]: Sadly, apple killed that statement with their liquid glass update 🫠
[^2]: On which this webpage works really well btw.
[^3]: Debatable opinion, but as much as I dislike "The Browser Company", their 
designers do a pretty dang good job.
[^4]: Again, very debatable, I don't always feel comfortable with this opinion.
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

        <title>Browsers</title>
        <meta name="description" content="My story about browser hopping, from being a kid to now and a reflection on accepting things that work even if they are imperfect." />

        <link rel="stylesheet" href="/assets/css/app.css">
        <script type="module" src="/assets/js/app.js"></script>
    </head>
    <body class="app app--<?= getTheme() ?>">
        <header>
            <canvas id="pets-canvas" class="center" aria-hidden="true"></canvas>
            <h1 class="center">Browsers</h1> 
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
