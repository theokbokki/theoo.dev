<x-md>
@verbatim
I've always liked the way templates are written in javascript frameworks like [Vue](https://vuejs.org) or [Svelte](https://svelte.dev).
It looks kinda like this:

```html
<script>
    console.log('Krusty krab pizza is the pizza for you and meeee!')
</script>

<div>Is Mayonnaise an Instrument?</div>

<style>
    div {
        color: hotpink;
    }
</style>
```

The thing is, I really hate using JS frameworks for anything else other than their templates.
So instead, I use [Laravel](https://laravel.com) and Blade for templating.
But as you may know, [Blade templates](https://laravel.com/docs/11.x/blade) don't work like Svelte or Vue ones.

So naturally when I saw [this video](https://www.youtube.com/watch?v=PkFuytYVqI8) about the new [:scope pseudo-element](https://developer.mozilla.org/fr/docs/Web/CSS/:scope) I got super excited to do this:

```html
<div>
    <blockquote>
        <p>The Inner Machinations of My Mind Are an Enigma.</p>
    </blockquote>
    <p>- Patrick Star</p>

    <style>
        @scope {
            :scope {
                background: #e2e8f0;
                padding: 1.5rem;
                border-radius: 4px;
            }

            blockquote {
                font-size: 1.25rem;

                & + p {
                    font-size: .75rem;
                }
            }
        }
    </style>
</div>
```

But the [browser support](https://caniuse.com/css-cascade-scope) for this isn't quite there yet and also, it doesn't really look like the JS framework templating that I like.

This sent me down a path of trying to recreate the JS framework templating experience inside of Blade templates.

## The `@pushOnce()` idea

My initial thought was to use the tools that come with Blade, so I digged in the docs and found the `@pushOnce()` directive.

This directive allows you to push content once into a `@stack` somewhere else in your page. It works like so:

```blade
<head>
    @stack('scripts')
</head>
```

```blade
@pushOnce('scripts')
    console.log('You look great today!');
@endPushOnce
```

I could then simply do this in my components:

```blade
@pushOnce('scripts')
<script>
</script>
@endPushOnce

<div>My component</div>

@pushOnce('styles')
<style>
</style>
@endPushOnce
```

And indeed it worked, and it looked a whole lot like JS framework templating, so all was good right?

Well, it turns out this approach has one big drawback; your styles and JS aren't compiled.

This is alright if you have a pretty small website, but when things start to get bigger, it can seriously increase the size of your pages and [that's not great](https://www.wholegraindigital.com/blog/how-to-page-weight-budget/).

## Finding a way to compile the styles and scripts

The first thing I tried was modifying the Blade renderer so it would take every `<script>` and `<style>` element, remove them and put their content inside a corresponding JS and CSS file. I made it work and it was good but then I realized that having every script and style tag removed from my code was a really bad idea.

Here's an example.
When I make a page load animation, I like to put `opacity: 0;` on all elements to avoid a flicker while the JS loads.
But this means users with JS disabled can't see my page, so I add this bit of code in my `<head>` to solve the problem.

```html
 <noscript>
    <style>
        body * {
            opacity: 1;
        }
    </style>
</noscript>
```

But if I remove every `<style>` tag, this stops working and that's not cool.

I thought about it for a bit and figured out that maybe a mix of my fist and second idea could work.
And that's when I started writing the [blade-sfc package](https://github.com/theokbokki/blade-sfc).

The package adds 2 Blade directives, `@js` and `@css` and they work like so:

```blade
@js()
<script>
    console.log('Once there was an ugly barnacle. He was so ugly that everyone died. The end.');
</script>
@endjs

<div>My component</div>

@css()
<style>
    div {
        background: hotpink;
    }
</style>
@endcss
```

Under the hood, when the Blade renderer encounters one of the directives, it's going to take everything inside it, strip it down of `<style></style>` and `<script></script>` tags and put the content inside a `generated.js` or `generated.css` file.

This solves all our problems, styles and scripts get compiled but you can still have `script` and `style` tags in your code when you need them.

## Bonuses

This way of doing things also has some benefits, because since the code is compiled, you are not limited to using CSS or JS, you could use [SCSS](https://sass-lang.com/) or [typescript](https://www.typescriptlang.org/) or anything your mind can dream of!

You just have to tell the directive where you want it to output the code like so `@js('resources/ts/generated.ts')`

Another cool side effect of writing JS and CSS directly in the Blade code is that you can write PHP inside the directives.

So no need to do this anymore:

```blade
<div style="background-image: {{ $post->thumbnail }}">
    Ravioli, Ravioli, Give Me the Formuoli.
</div>
```

Instead you can do this:

```blade
@css()
<div>I'm a Goofy Goober, Yeah! You're a Goofy Goober, Yeah! We're All Goofy Goobers, Yeah! Goofy, Goofy, Goofy, Goofy Goober, Yeah!</div>

<style>
    div {
        background-image: {{ $post->thumbnail }};
    }
</style>
@endcss
```

If you wanna try writing Blade single file components, you can find [the code and documentation of the package on github](https://github.com/theokbokki/blade-sfc).
@endverbatim
</x-md>