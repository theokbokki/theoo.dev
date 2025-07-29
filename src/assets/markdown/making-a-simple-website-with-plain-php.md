I'm a lucky developer, I started coding when things were already really good in the web development space.  
I didn't ever have to touch <a href="https://jquery.com" taraget="_blank">JQuery</a> (except for that one pesky legacy project at work), because Javascript was already doing great. I only did plain PHP for a couple months, then we quickly learned about <a href="https://laravel.com" target="_blank">Laravel</a> which was already an established framework with tons of great features. Heck I didn't even ever have to use <a href="https://wordpress.org/" target="_blank">Wordpress</a> and my job is to be a PHP dev!

So as I was reading <a href="https://slrncl.com/colophon" target="_blank">Nicolas Solerieu's colophon</a>, this bit caught my eye.

> The world we live in requires us to keep building and fixing things. So I'm here making websites with good old jquery, html, php, and css.

Usually, I will always boot up a Laravel project, Install <a href="https://sass-lang.com/" target="_blank">SASS</a> or <a href="https://tailwindcss.com/" target="_blank">Tailwind</a> and to be fair I already use vanilla JS.  
But this time I want to do things differently. I want to figure out how to build a very simple website using only the plain stuff—PHP, and CSS (This site won't need JS).

--- 

The website I'm going to build is a very simple _owns_ one page site. The principle of an owns site, is to make a big list of all the things you own and feel like sharing with the world.

I chose this particular idea because I've been meaning to do this for a long time, and didn't want to make it a simple list in a note on this site. Also, I only have about a weekend to do it and I think this should be feasible.
The requirements for this site are pretty minimal, I want it to be static, so no admin and no DB and it should be pretty or at least I will try! That's it :))

--- 

First step is to get the project running locally, and luckily for me, I already have <a href="https://herd.laravel.com/" target="_blank">Herd</a> installed on my machine. As they describe it:
> One click PHP development environment. Zero dependencies. Zero headaches.

And they are pretty right, sorry <a href="https://www.mamp.info/en/mac/" target="_blank">MAMP</a>, you've been replaced.

Then, once autoloading with <a href="https://getcomposer.org/" target="_blank">composer</a> is setup, base files and folders are created and all the boilerplate HTML stuff is put in place, I can start to write some PHP in my beautiful brand new `index.php`. 

The first hurdle I run into is code duplication. I'm creating the different items that will display my objects, but I don't want to copy the same code over and over. Imagine I mess up in the future and need to change something a lot of times? Not nice.  
Usually in Laravel I simply use blade components. So let's try to create "components" but in plain PHP.

Based on my prior Laravel knowledge, I build a class for my component, with a `constructor` and a `render` method. But in the `render` method, instead of passing in the name of the blade file, I write the code directly.  
To be totally honest, I think I like this! I'm not the biggest fan of <a href="https://en.wikipedia.org/wiki/Separation_of_concerns" target="_blank">separation of concerns</a> and having my logic and my markup in the same file feels great.

```php
class Item implements Component
{
    use IsComponent;

    public function __construct(
        public string $title,
        public string $img,
        public string $alt,
    ) {}

    public function render(): string
    {
        return <<<HTML
            <article class="item">
                <h2 class="item__title">{$this->title}</h2>
                <img class="item__img" src="/img/{$this->img}" alt="{$this->alt}">
            </article>
        HTML;
    }
}
```

You might notice there are also two other things being used in this file—The `IsComponent` trait and the `Component` Interface.  
I personally prefer <a href="https://en.wikipedia.org/wiki/Composition_over_inheritance" target="_blank">Composition over Inheritance</a> and I thought ahead a bit for this project and already abstracted some of the common things for all my components in these classes. Here they are:

```php
Trait IsComponent
{
    public static function make(...$arguments): self
    {
        return new static(...$arguments);
    }
}
```

The trait is really small for now, it only has a `make` function that creates a new static instance of the `Component`. This is a pattern we use a lot at work and I really like it, it allows you to create new classes like this: `Item::make('my-item')` which I think is nicer than `new Item('my-item')`.

Then the `Component` interface is there to enforce the presence of some functions on my little components. As simple as that:

```php
Interface Component
{
    public function render(): string;

    public static function make(...$arguments): self;
}
```

Now that all of this is setup, I can try rendering the components in the `index.php` file, and thanks to all the prior work this is now really trivial:

```php
<?php

$items = [
    Item::make(
        'Orange miffy book', 
        'le-monde-de-miffy.webp',
        'An orange Miffy book with at the center, Miffy playing with a beach ball in her blue dress and at the top the title &quot;Le monde de miffy&quot; written in orange'
    ),
    Item::make(
        'Clear casio watch', 
        'clear-casio.webp',
        'A casio digital watch with a clear bracelet and a white watch face'
    ),
];

?>

<!DOCTYPE html>
<html lang="en">
    <head>/* ... */</head>
    <body class="app">
        <?php foreach($items as $item): ?> 
            <?= $item->render() ?>
	    <?php endforeach ?>
    </body>
</html>
```

The PHP part at the top acts a bit like a controller, and then I can easily use the variables defined there inside of my markup.  
I think that this setup works pretty nicely, now I'm going to move on to some styling.

--- 

I usually use SASS on my projects, because it allows me to use convenience features like nesting without having to worry about browser support and also to define functions like `rem()` which allows me to write the values in px and get them divided automatically. But using plain CSS doesn't actually feel so bad—sure you have to write more selectors and the code is more verbose, but for simple websites like this one, I think it's plenty good enough.

But doing my website this way I ran into an issue, I would make changes in my CSS and the page wouldn't reflect them when I refreshed. I ended up figuring out this was because of caching and that the browser wouldn't update a file whose name hadn't changed!

To avoid this problem, I add a simple `asset()` helper function that will do query string cache busting. (I know it's not ideal but clearly enough for this website).  

```php
function asset(string $path): string
{
    $fullPath = 'assets/'.$path;
    $time = filemtime($fullPath);

    return '/'.$fullPath.'?v='.$time;
}
```

---

Last thing that's left to do is to publish the site, and this is incredibly easy. I simply have to create a new subdomain on my <a href="https://www.infomaniak.com/en" target="_blank">Infomaniak</a> dashboard, clone the repo on the server and make the subdomain point to the `public` directory. DONE!

This experiment was a blast, and it made me reflect on the current state of web development. We are in a weird moment where we have great tools that can do a ton of things and have great resources for learning them, therefore we feel entitled to use them for everything, and I'm guilty of this myself.  
But I think that a step back before building a project might be worth it sometimes. Do I really need a whole Laravel app with an admin panel to make my simple personal webpage? Do I really need to use _Insert name of JS tool_ for building this functionality? Maybe not.
Plus, I think that doing things this way has taught me way more about PHP and server stuff than a lot of time spent building Laravel websites. I now know about why we use a public directory, what `.htaccess` is, how to do simple cache busting, how Composer autoloading works, how my server views my app, and many other things I didn't talk about because they are out of the scope of this article.
When I inevitably want to rebuild this site in a couple months (I'm aiming to keep it as it is for one year and it's so hard), I might do it using plain PHP, my requirements aren't that high after all.

There's also one more thing I would like to experiment on this website, using a Makefile to bundle all my css files into a single minified one.
I've seen many articles and videos where people would use a Makefile to do all sorts of cool things and I think that for once that I don't have Vite to handle everything for me, I might give it a go.  
But that will be for another time, I first have to learn how Makefiles work!

If you have ideas or opinions you'd like to share, feel free to <a href="mailto:hello@theoo.dev">send me an email</a>, I'd be pleased to read it :)) Have a nice day.

--- 

Update:  
I spent some time learning Makefiles (Though I think I've only scratched the surface), and I've come up with a very simple build system for basic PHP websites.
You can read more about it in <a href="/notes.php?name=simple-php-build-system">Simple PHP build system</a>, I've also made <a href="/snippets.php?name=useful-makefile-rules" target="_blank">a snippet grouping some Makefile rules</a> for different use cases.

Since then, as you may have noticed, I moved my whole main website to this approach of using only PHP and no frameworks. It has been great so far, I hope it continues to be!
