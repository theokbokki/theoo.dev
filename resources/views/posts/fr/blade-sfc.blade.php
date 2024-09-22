<x-md>
@verbatim
J'ai toujours aimé la façon dont les templates sont écrits dans les frameworks JavaScript comme [Vue](https://vuejs.org) ou [Svelte](https://svelte.dev).
Ça ressemble à ça:

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

Le problème, c'est que je déteste utiliser les frameworks JS pour autre chose que leurs templates.
Alors à la place, j'utilise [Laravel](https://laravel.com) et Blade pour la création de templates.
Mais comme vous le savez peut-être, les [templates Blade](https://laravel.com/docs/11.x/blade) ne fonctionnent pas comme ceux de Svelte ou Vue.

Donc évidemment, quand j'ai vu [cette vidéo](https://www.youtube.com/watch?v=PkFuytYVqI8) sur le nouveau pseudo element [:scope](https://developer.mozilla.org/fr/docs/Web/CSS/:scope), j'étais super excité de faire ça:

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

Mais le [support](https://caniuse.com/css-cascade-scope) pour `@scope` n'est pas encore au point, et aussi, ça ne ressemble pas vraiment à la manière de faire des templates dans les frameworks JS.

Cela m'a conduit à essayer de recréer l'expérience des templates des frameworks JS dans les templates Blade.

## L'idée du `@pushOnce()`

Ma première pensée a été d'utiliser les outils fournis avec Blade, alors j'ai fouillé dans la documentation et trouvé la directive `@pushOnce()`.

Cette directive permet de pousser du contenu une seule fois dans une `@stack` ailleurs dans votre page. Ça fonctionne comme ça :

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

Je pouvais alors simplement faire ça dans mes composants:

```blade
@pushOnce('scripts')
<script>
</script>
@endPushOnce

<div>Mon composant</div>

@pushOnce('styles')
<style>
</style>
@endPushOnce
```

Et effectivement, ça fonctionnait, et ça ressemblait beaucoup aux templates des frameworks JS, donc tout allait bien, non ?

Eh bien, il s'avère que cette approche a un gros inconvénient; vos styles et JS ne sont pas compilés.

C'est acceptable si vous avez un site assez petit, mais quand les choses commencent à devenir plus importantes, cela peut sérieusement augmenter la taille de vos pages, et [ce n'est pas idéal](https://www.wholegraindigital.com/blog/how-to-page-weight-budget/).

## Trouver un moyen de compiler les styles et scripts

La première chose que j'ai essayée était de modifier le moteur de rendu de Blade afin qu'il prenne chaque élément `<script>` et `<style>`, les retire et place leur contenu dans un fichier JS et CSS correspondant. J'ai réussi à le faire fonctionner, mais je me suis rendu compte qu'enlever chaque balise script et style de mon code était une mauvaise idée.

Voici un exemple.
Quand je fais une animation de chargement de page, j'aime mettre `opacity: 0;` sur tous les éléments pour éviter un clignotement pendant le chargement du JS.
Mais cela signifie que les utilisateurs avec JS désactivé ne peuvent pas voir ma page, donc j'ajoute ce bout de code dans mon `<head>` pour résoudre le problème.

```html
<noscript>
    <style>
        body * {
            opacity: 1;
        }
    </style>
</noscript>
```

Mais si je retire toutes les balises `<style>`, cela cesse de fonctionner, et c'est pas cool.

J'y ai réfléchi un peu et j'ai réalisé qu'un mélange de ma première et seconde idée pourrait fonctionner.
C'est là que j'ai commencé à écrire le package [blade-sfc](https://github.com/theokbokki/blade-sfc).

Ce package ajoute deux directives Blade, `@js` et `@css`, qui fonctionnent comme suit:

```blade
@js()
<script>
    console.log('Once there was an ugly barnacle. He was so ugly that everyone died. The end.');
</script>
@endjs

<div>Mon composant</div>

@css()
<style>
    div {
        background: hotpink;
    }
</style>
@endcss
```

En arrière-plan, lorsque le moteur de rendu de Blade rencontre une des directives, il prend tout le contenu à l'intérieur, retire les balises `<style></style>` et `<script></script>`, et place le contenu dans un fichier `generated.js` ou `generated.css`.

Cela résout tous nos problèmes, les styles et scripts sont compilés, mais vous pouvez toujours avoir des balises `script` et `style` dans votre code quand vous en avez besoin.

## Bonus

Cette manière de faire présente aussi des avantages, car comme le code est compilé, vous n'êtes pas limité à utiliser CSS ou JS, vous pouvez utiliser [SCSS](https://sass-lang.com/) ou [typescript](https://www.typescriptlang.org/) ou tout ce dont vous pouvez rêver!

Il suffit simplement d'indiquer à la directive où vous voulez qu'elle génère le code, comme ceci: `@js('resources/ts/generated.ts')`.

Un autre effet cool du fait d'écrire du JS et du CSS directement dans le code Blade est que vous pouvez écrire du PHP à l'intérieur des directives.

Plus besoin de faire ça :

```blade
<div style="background-image: {{ $post->thumbnail }}">
    Ravioli, Ravioli, Give Me the Formuoli.
</div>
```

À la place, vous pouvez faire ça :

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

Si vous voulez essayer d'écrire des composants à fichier unique Blade, vous pouvez trouver [le code et la documentation du package sur GitHub](https://github.com/theokbokki/blade-sfc).
@endverbatim
</x-md>
