<x-common::layout baseClass="home">
    <h1 class="sro">Homepage of Théo's website</h1>
    <x-common::nav></x-common::nav>
    <main class="home__content" data-focus-section="home-content">
        <p class="home__text">Hey there, welcome to my website!</p>
        <p class="home__text">I’m Théo, and I run this place :))</p>
        <p class="home__text">Please take a seat, a cup of good coffee and stay for as long as you’d like.</p>
        <img
            src="{{ Vite::asset('modules/common/resources/images/home.png') }}"
            alt="A green slipper chair and a yellow plastic child's stool on top of which is a cup of coffee covered in stylized cheetas."
            class="home__img"
        />
        <p class="home__text">I love chatting, so don’t hesitate to send me a mail at <a href="mailto:hello@theoo.dev" class="home__link" data-focus-ring data-focus-inset-x="4">hello@theoo.dev</a> or DM me on <a href="https://instagram.com/theokbokki" class="home__link" data-focus-ring data-focus-ring data-focus-inset-x="4">Instagram</a>.</p>
        <p class="home__text">I hope you’ll have a wonderful day!</p>
    </main>
</x-common::layout>
