<?php

require_once __DIR__.'../../src/Helpers.php';

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

        <title>Home</title>
        <meta name="description" content="" />

        <link rel="stylesheet" href="/assets/css/app.css">
        <script type="module" src="/assets/js/app.js"></script>
    </head>
    <body class="app app--<?= getTheme() ?>">
        <canvas id="pets-canvas" class="center" aria-hidden="true"></canvas>
        <h1 class="center">Theoo</h1>
        <p class="center">Welcome to my place on the internet! I mostly write stuff, but also like design, shaders and coding in general.</p>
        <hr>
        <p class="center">You can contact me at <a href="mailto:hello@theoo.dev">hello@theoo.dev</a></p>
        <hr>
        <h2>Notes</h2>
        <ul>
            <li>
                <a href="/notes/books-i-read.php">Books I read</a>
            </li>
        </ul>
        <hr>
        <h2>Snippets</h2>
        <ul>
            <li>
                <a href="/snippets/default-pluton-class.php">Default Pluton class</a>
            </li>
        </ul>
        <hr>
        <h2>My other projects</h2>
        <ul>
            <li>
                <a href="https://feed.theoo.dev">My feed website — Basically a micro-blog</a>
            </li>
            <li>
                <a href="https://nuggets.theoo.dev">Nuggets — A place for me to experiment with nice but unpractical UIs</a>
            </li>
        </ul>
        <hr>
        <h2>Links</h2>
        <ul>
            <li><a href="https://manuelmoreale.com/">The personal website of Manuel Moreale</a></li>
            <li><a href="https://blogroll.org/">Blogroll.org — A curated list of many blogs</a></li>
            <li><a href="https://slrncl.com/">The personal website of Nicolas Solerieu</a></li>
            <li><a href="https://animejs.com/">Anime JS — Vanilla JS animation library</a></li>
            <li><a href="https://emilkowal.ski/ui/great-animations">Great animations — Article by Emil Kowalski</a></li>
            <li><a href="https://www.lemarais407.be/">Le marais — Coworking space in Brussels</a></li>
            <li><a href="https://www.curationofcurations.com/Curated-sites">Curation of curations — Curated sites</a></li>
            <li><a href="https://pierre.co/">Pierre.co</a></li>
            <li><a href="https://barbaraschussmann.de/">Barbara Schussmann — UX Designer and Artist</a></li>
            <li><a href="https://softglossary.space/">Soft Glossary — Code over no-code</a></li>
            <li><a href="https://3jce9mqry.sites.cv/">Seoul — A ReadCV template website</a></li>
            <li><a href="https://www.cameronsworld.net/">Cameron's World — An ode to the 90's web</a></li>
            <li><a href="https://gomakethings.com/">Go make things</a></li>
            <li><a href="https://littlefatboy.com/">Little fat boy — Great recipes</a></li>
            <li><a href="https://higherorderco.com/">Higher Order Co — The bend programming language</a></li>
            <li><a href="https://jakub.kr/">Personal website of Jakub Krehel</a></li>
            <li><a href="https://toonvandenbos.com/">Personal website of Toon Van den Bos</a></li>
            <li><a href="https://airtraveldesign.guide/Guide">Air travel design guide</a></li>
            <li><a href="https://www.interface.watch/">Interface watch — A place of inspiration for watchOS apps</a></li>
            <li><a href="https://cameronaskin.com/">The personal website of Cameron Askin</a></li>
            <li><a href="https://nicolasgallagher.com/about-html-semantics-front-end-architecture/">About HTML semantics and front-end architecture</a></li>
            <li><a href="https://oem.care/">OEM — Online drug store</a></li>
            <li><a href="https://www.citationneeded.news/we-can-have-a-different-web/">We can have a different web</a></li>
            <li><a href="https://naotofukasawa.com/">The website of Naoto Fukasawa</a></li>
            <li><a href="https://www.wimpdecaf.com/">Wimp — Decaf coffee</a></li>
            <li><a href="https://thedesignfiles.net/2022/08/studio-visit-beci-orpin-ellie-king">Beci Orpin's Studio</a></li>
            <li><a href="https://www.beciorpin.com/">Beci Orpin's website</a></li>
            <li><a href="https://valuable-colleagues-147045.framer.app/">Nightshift</a></li>
            <li><a href="https://inventory.linusrogge.com/">Linus Rogge's inventory</a></li>
            <li><a href="https://linusrogge.com/">Personal website of Linus Rogge</a></li>
            <li><a href="https://motion-primitives.com/">Motion Primitives</a></li>
            <li><a href="https://teenage.engineering/products/ep-1320">EP-1320 — The coolest medieval instrument</a></li>
            <li><a href="https://cursor.design/">Cursors — Macos cursors SVGs</a></li>
            <li><a href="https://arc.net/search">Arc search</a></li>
            <li><a href="https://blog.jim-nielsen.com/2024/sanding-ui/">Sanding UI</a></li>
            <li><a href="https://michaeluloth.com/neovim-switch-configs/">Switching configs in Neovim</a></li>
            <li><a href="https://www.stitson.com/pub/book_html/node89.html">Ed — The line editor</a></li>
            <li><a href="https://www.cosmos.so/cosmos/genesis/canvas">Cosmos—Genesis</a></li>
            <li><a href="https://reflex.dev/">Reflex — Frontend. Backend. Pure Python.</a></li>
            <li><a href="https://www.easing.dev/">Easing graphs</a></li>
            <li><a href="https://marioecg.com/">Mario Carrillo's website</a></li>
            <li><a href="https://modalzmodalzmodalz.com/">Modalz Modalz Modalz</a></li>
            <li><a href="https://btxx.org/">Bradley Taunt's website</a></li>
            <li><a href="https://longform.asmartbear.com/slc/">Your customers hate MVPs. Make a SLC instead.</a></li>
            <li><a href="https://abhisaha.com/blog/exploring-browser-rendering-process">Exploring the browser rendering process</a></li>
            <li><a href="https://grugbrain.dev/">Grugbrain — AKA my way of life</a></li>
            <li><a href="https://dev.to/thepassle/events-are-the-shit-b3i">Events are the shit</a></li>
            <li><a href="https://justinjay.wang/methods-for-random-gradients/">Methods for random gradients</a></li>
            <li><a href="https://melonking.net/">Melon King</a></li>
            <li><a href="https://leloup.dev/">Personal website of Adrien Leloup</a></li>
            <li><a href="https://jonathanrixhon.dev/">Jonathan Rixhon's website</a></li>
            <li><a href="https://gjphenry.be/">GJP Henry's website</a></li>
            <li><a href="https://www.figma.com/blog/making-space-for-a-handmade-web/">Making space for a handmade web</a></li>
            <li><a href="https://solar.lowtechmagazine.com/">Low tech magazine — Solar powered website</a></li>
            <li><a href="https://jamesg.blog/">James' coffee blog</a></li>
            <li><a href="https://surma.dev/things/ditherpunk/">Ditherpunk — An in depth article about the math behind dithering</a></li>
            <li><a href="https://meyboom.space/">Meyboom — Artist-run spaces in Brussels</a></li>
            <li><a href="https://www.specs.work/">Specs — Brussels based architecture practice</a></li>
            <li><a href="https://www.verdeil.net/">Website of Marie Verdeil</a></li>
            <li><a href="https://test.roelof.info/">Website of Roel Roscam Abbing</a></li>
            <li><a href="https://appstacks.club/">App Stacks</a></li>
            <li><a href="https://archive.saman.design/">Saman Archive</a></li>
            <li><a href="https://www.funnyfriends.com/celestial">Funny Friends — Whimsical plushes</a></li>
            <li><a href="https://www.are.na/anne-lee/alt-web-ddwo8t9ndfw">alt ✦ web — Anne Lee</a></li>
            <li><a href="https://deadsimplesites.com/">Dead simple sites</a></li>
            <li><a href="https://maxibestof.one/">Maxi Best Of</a></li>
            <li><a href="https://land-book.com/">Land Book</a></li>
            <li><a href="https://www.siteinspire.com/">Siteinspire</a></li>
            <li><a href="https://minimal.gallery/">Minimal gallery</a></li>
            <li><a href="https://httpster.net/">httpster</a></li>
            <li><a href="https://loadmo.re/">Loadmore</a></li>
            <li><a href="https://godly.website/">Godly website</a></li>
            <li><a href="https://koto.studio/work/amazon/">Koto Studio — Amazon case study</a></li>
            <li><a href="https://www.pathem.es/">Pathêmes</a></li>
            <li><a href="https://mutantx.bip-liege.org/">Mutantx — Biennale de l’Image Possible</a></li>
            <li><a href="https://ericreh.de/en">Eric Reh</a></li>
            <li><a href="https://aintnotrash.com/en">Ain't no trash</a></li>
            <li><a href="https://www.mayabakir.com/desktop.html">Maya's sketchbook</a></li>
            <li><a href="https://os.ryo.lu/">ryOS</a></li>
            <li><a href="https://www.mmmx.cloud/">MMMX.☁️</a></li>
            <li><a href="https://alexharri.com/blog/webgl-gradients">WEBGL Gradients — Alex Harri</a></li>
            <li><a href="https://alexharri.com/">Alex Harri</a></li>
            <li><a href="https://hturan.com/writing/complex-numbers-glsl">Visualizing Complex Numbers Using GLSL</a></li>
            <li><a href="https://carlbarenbrug.com/">Carl Barenbrug's homepage</a></li>
            <li><a href="https://peopleandblogs.com/">People and blogs — A newsletter interviewing people who blog</a></li>
            <li><a href="https://patrickfry.co.uk/">Patrick Fry studio</a></li>
            <li><a href="https://designwork.it/">Design Work Studio</a></li>
            <li><a href="https://atto.si/">Atto</a></li>
            <li><a href="https://giuliafaraon.com/">Giulia Faraon</a></li>
            <li><a href="https://reubenson.com/">Reuben Son</a></li>
            <li><a href="https://internetphonebook.net/">Internet Phone book</a></li>
            <li><a href="https://www.makingsoftware.com/">Making Software — A very very nicely made online book</a></li>
            <li><a href="https://walknotes.com/">Walk notes</a></li>
            <li><a href="https://guillaumevg.substack.com/">Guillaume Cooks Vegan</a></li>
            <li><a href="https://spencer.place/">Spencer's place</a></li>
            <li><a href="https://johnprovencher.com/">John Provencher's website</a></li>
        </ul>
        <p class="banner">This website is in transition. I haven't yet migrated all my articles/snippets but they will be there soon.</p>
    </body>
</html>
