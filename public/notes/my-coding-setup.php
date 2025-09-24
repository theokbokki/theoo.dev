<?php

require_once __DIR__.'../../../src/Parsedown.php';
require_once __DIR__.'../../../src/ParsedownExtra.php';
require_once __DIR__.'../../../src/Helpers.php';

$content = (new ParsedownExtra())->text(<<<NOTE
I have been coding for a few years now, and in that time, I have done nothing but remove complexity from my coding setup and I feel like I've reached a point where I'm happy with it. 
My favourite editor is [ed](https://www.gnu.org/fun/jokes/ed-msg.html), but [I can't really use it much](TKTK), therefore, I've settled on [Neovim](https://neovim.io)[^1]. I like the keyboard centric editing it offers, and it's actually really fun to use once you've mastered the Vim language.
Neovim is a very capable editor, offering all you could imagine from _modern_ IDEs (LSP, Autocomplete, Fuzzy finding, Plugins, Diagnostics,...), but I try to stray away from all these, keeping a very minimal approach to code editing.

The number one thing I don't have is a colorscheme. My code is black on white with a tiny bit of grey for comments, you might be thinking that this makes it hard to parse code and find what you want, but that's exactly the point. Since my eyes have few visual cues to grab onto, I've been forced to read the code to know what is happening, and that has in turned made me so much better at understanding and reading other people's code quickly. It also feels (to me at least) like my eyes are less strained after a day of working in black and white.

Another thing I don't use is autocomplete, neither the box that appears as you type or inline AI stuff like copilot. I've found that by removing these helpers, I actually had to learn the language I was writing my code in. Learn the order of arguments, the names of functions you only use ever so often, the names of the variables scattered throughout a project, and even namespaces[^2] of the packages installed on the project.
Having the completion popup appear all the time was taking me out of my focus to read whatever it had to say and then validate it. Now I just write, without stopping, without breaking the flow. And it is often faster to do it this way rather than parse a list in a popup and select the right one.

I've also stopped using LSPs. This one was a hard choice, because LSPs provide 3 features that I heavily relied on: renaming, go to definition and file outlines. My solution to get rid of those is that I've started using grep or simply, my file finder. For sure it takes more time looking through a package's files to find out where a function is defined, but using ripgrep often makes it much quicker[^3] and I've found that searching manually through code allows you to learn the structure of the packages and over time, you get much better at using them.
Another side effect of disabling LSP, is that I don't get squiggly lines when I make a mistake anymore. At first I thought it was gonna be a mess, that I would make so many typos or forget semi-colons and search for them for hours. But my brain quickly adapted, I started making less typos, and always keeping my eye on the back of my cursor to make sure I caught myself writing shit right away. I started double checking my code a lot more, to make sure there was no mistake, which often results in me finding ways to improve the code despite it being correct in the first place. You also become much quicker at finding the typos, your brain knows what common errors you make and searches for these in priority. And finally for the odd times where you can't find it, your language probabbly has some sort of linter you can run on the file that will tell you the problem.

So the only thing I've really kept aside from the ability to write text is a fuzzy finder that can search both file names and file contents[^4]. This is one of the most powerful features of my workflow, because since I don't have LSP to go to definition or other things like that, I use my fuzzy finder to navigate pretty much everywhere. But lately, I've slowly started replacing it with actual [ripgrep](https://github.com/BurntSushi/ripgrep) and [fzf](https://github.com/junegunn/fzf) in the terminal. When I do that, I also often use [bat](https://github.com/sharkdp/bat) to preview the files and only jump in nvim when I know exactly what I'm going to modify.
Another thing I use is [Oil.nvim](https://github.com/stevearc/oil.nvim), it's a file explorer that works like a buffer, meaning you can edit the contents of directories, the names of files etc like if you were writing code. I don't have much to say about this, I just like it and have found it works better than NETRW[^5] for moving files around. 

Outside of my editor, I use [tmux](https://github.com/tmux/tmux/wiki), a terminal multiplexer which allows me to create many sessions for all the different projects. The terminal I use is [Ghostty](https://ghostty.org/), it is fast, looks good and that's all I really need from a terminal. For git stuff, I'm a big fan of [GitHub Desktop](https://github.com/apps/desktop), because its GitHub integrations are on point and it simplifies many hard to remember git commands. My browser of choice is [Zen](https://zen-browser.app/) but as I discussed in [my blog post about browsers](TKTK), I'm never really sold or satisfied with the browser I use.

That's it for my coding setup, it might[^6] change in the future, at which point I can write an updated blog post. But for now, I think that this pretty bare bones setup is good for me. It forces me to actually learn the programming languages I use and understand the codebases I work on, the more I code and the more I get a feeling for how code should be written, how to refactor better,... . If I had one change to really recommend from all the above, it would be to disable your autocomplete. I know that in today's coding landscape this is a weird advice with tools like Claude Code or Cursor where AI writes the code for us, but I swear that you will see improvements in your understanding of the code in very little time.

If you have questions, or want to share your coding setup, please feel free to [send me an email](mailto:hello@theoo.dev), I would be please to read what you have to say ^^.

[^1]: A modern version of vim, scripted in lua and with a really active community.
[^2]: Talking about PHP here, a namespace is this for example `Theoo\App\Components`. It allows your code to differenciate between two classes with the same name but under different namespaces.
[^3]: `--no-ignore-vcs` my beloved ❤️
[^4]: I'm using [Telescope](https://github.com/nvim-telescope/telescope.nvim).
[^5]: Vim's default file explorer.
[^6]: _Will for sure_
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
