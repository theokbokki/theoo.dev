<x-layout base-class="home">
    <style>
        :root {
            --home-bg: {{ $theme->bg }};
            --home-link-color: {{ $theme->link }}
        }
    </style>
    <header class="home__header">
        <h1 class="home__title">
            <span class="sro">Théoo dot dev</span>
            <img src="{{ Vite::asset('resources/img/home-title.svg') }}" alt="" class="home__image"/>
        </h1>
        <x-nav/>
    </header>
    <main class="home__main">
        <p class="home__text">
            Hey internet traveller welcome to Theoodotdev!
        </p>
        <p class="home__text">
            This is my home on the web, a place for me to share and collect many things.
        </p>
        <p class="home__text">
            By clicking around, you may end up reading <a href="#" class="home__link">my notes</a> or <a href="#" class="home__link">my personal timeline</a>.</br>
            You could also look at <a href="#" class="home__link">some designs I made</a> or click on <a href="#" class="home__link">some links I like</a>.
        </p>
        <p class="home__text">
            If you want to learn more about me, click on my face in the top left corner, and if you ever get lost, the menu button in the top right should get you back on track.
        </p>
        <p class="home__text">
            I love chatting, so if you want to talk about something like your favourite dinosaur or share some juicy story, you can do it at <a href="mailto:hello@theoo.dev" class="home__link">hello@theoo.dev</a> or on <a href="https://instagram.com/theokbokki" class="home__link">Instagram</a>.
        </p>
        <p class="home__text">
            I hope you have a wonderful day!
        </p>
    </main>
</x-layout>
