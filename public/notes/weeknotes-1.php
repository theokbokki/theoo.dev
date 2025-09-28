<?php

require_once __DIR__.'../../../src/Parsedown.php';
require_once __DIR__.'../../../src/ParsedownExtra.php';
require_once __DIR__.'../../../src/Helpers.php';

$content = (new ParsedownExtra())->text(<<<NOTE
This is my first weeknotes note 🎉
I don't really know what's usual about these things. I've read a bunch of Weeknotes on my phone and it seems everyone does as they please, so I'm gonna do the same.

### WHAT HAPPENED THIS WEEK
- I got more used to having Neko (My dog) and it feels like a huge win! I'm no longer extra tired and we've been able to settle in a sorta routine that works well.  
  She still pees inside but less so which is encouraging.
- I started working on a _weekend project_. A simple menu bar app to convert files (at first only to WebP but I plan on adding more file types). I really wanted to try PHPNative and I needed an app to convert files so I thought this would be a great occasion ^^.  I will write more about it soon.  
  If you're curious, here's a link to the [github repo](https://github.com/theokbokki/to-webp).
- I worked on a few fun things at worked and had to do my first price estimation for a project 😬 That was hella scary and I never want to do it again but I will definitely have to... Hopefully I wasn't too off the mark.
- The [_Foire de Liège_](https://en.wikipedia.org/wiki/Foire_de_Li%C3%A8ge)[^1] is soon starting and the ferris wheel is right in front of my home. It's always impressive to see them build such a big thing in a matter of a few days. I'm a bit scared for the _Foire_ to start this year cause idk how Neko is going to react. She's really scared of people.
- It's officially Spooky Season! We bought a new XXL blanket to enjoy warm drinks in front of halloween movies with my SO. It's really our favourite season and I can't wait to enjoy it all. The colors are just so nice!!!

### LINKS OF THE WEEK
- https://chotrin.org/philosophy/unreachable.html  
  An article about being unreachable in the 21st century. I think the perspective and the website are both really interesting.
- https://cursor.com/  
  I hate AI, but dang it did the Cursor team do a great website! The interactable windows in the hero section are a masterclass. I also like that they didn't go for the ✨sparky✨, neon AI vibe that we see everywhere. It's simple minimal and well executed.
- https://kedara.eu/organising-feeds-permaculture  
  An article about organising RSS feeds based on permaculture principles. This is a super interesting perspective and a system that I think would work great for me in many areas.
- https://mtwb.blog/posts/2025/blaugust2025/not-every-blog-post-needs-to-be-epic/  
  I really agree with this post. I like to publish stuff that feels _half baked_ and I don't care about perfection. The point is to throw stuff in the void and sometimes it replies back.
- https://pjonori.blog/posts/i-dont-want-your-email/  
  A lot of great reasons not to have a newsletter. You can still send me an email if you want though ^^.
- https://fossheim.io/writing/posts/accessible-theme-picker-html-css-js/  
  Don't agree with everything here, but this gave me the idea to do the same! So this website will receive a theme picker soon and it's (partly) thanks to this article.
- https://tink.uk/perceived-affordances-and-the-functionality-mismatch/  
  Such a great principle of accessibility. Use the stuff that's made for doing the stuff you want to do. Need radio buttons? Use radio buttons. If they don't match your design, the design is to be rethought, not the HTML element.
- https://theoatmeal.com/comics/unhappy  
  A fun, comic about the meaningless nature of happiness and how other feelings are much better to express your emotions.
- https://messenger.abeto.co/  
  I don't know how they did this, but Abeto cooked so so hard on this website. It's a 3D game in a very _Ghibliesque_ style that is RESPONSIVE (how tf do you make a responsive 3D game) where you deliver mail to residents of a tiny and super detailed planet.
- https://tarneo.fr/posts/minimal_web/  
  I love the propositions of this article for a _minimal web search engine_. The way it's describe and the logic behind it seem great to me and if anyone with the skills to do that passes by, please do it!

### WHAT I WATCHED THIS WEEK
- Alice in Borderland (the series)  
  I liked season one and two (especially season two) but was really disappointed by season three. The games were less fun and the ending is mighty frustrating. It feels like another _Netflix likes money_ series.
- We Have a Ghost  
  What even is that? To be fair, we didn't finish the movie, but it sucked so so hard. It's one of these movies where they push the _Netflix woke_ (Gosh I hate that word) to the max and it just feels forced.

### WHAT I LISTENED TO THIS WEEK

#### MUSIC
- Twenty One Pilots — _Breach_  
  IMO their best album. I hadn't said that since _Blurryface_. Every song feels TOP.
- Mac DeMarco  
  I love all his music. The dude is just too good. His latest album _Guitar_ is so chill and works so well with the season's vibe.
- My Chemical Romance — The Black Parade  
  Probably in my top ten albums all time. It never gets old.
- Masayoshi Takanaka  
  The dude knows how to play guitar... I'm always impressed and in a good mood when I listen to him.

#### PODCASTS
- [_Les Goûts Les Couleurs_](https://smartlink.ausha.co/lglc)  
  This podcast is so much fun. I listen to it when doing my groceries (and only then, I wait till I have to do my groceries for listening) and always end up laughing to myself in the shop.
- [_Through the Griffin Door_](https://www.youtube.com/@ThroughTheGriffinDoor/videos)  
  A podcast that deep dives on each Harry Potter chapter. To be honest I don't know all that much about the series. I have seen every movie once and the 4 first ones a bunch more and have never read the books. It's a weird way to discover something than to have two really knowledgeable people do a deep dive on something you don't know all that much about.

[^1]: Here's [the French wikipedia page](https://fr.wikipedia.org/wiki/Foire_de_Li%C3%A8ge) with more infos for those interested and who can read French.
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

        <title>Weeknotes 1</title>
        <meta name="description" content="" />

        <link rel="stylesheet" href="/assets/css/app.css">
        <script type="module" src="/assets/js/app.js"></script>
    </head>
    <body class="app app--<?= getTheme() ?>">
        <header>
            <canvas id="pets-canvas" class="center" aria-hidden="true"></canvas>
            <h1 class="center">Weeknotes 1</h1>
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
