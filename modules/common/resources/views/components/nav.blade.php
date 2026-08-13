<nav class="nav">
    <h2 class="sro">Main navigation</h2>
    <a href="#" class="nav__about">
        <span class="sro">Go to about page</span>
        <img src="{{ Vite::asset('modules/common/resources/images/avatar.png') }}" alt="Me in a hoodie with my tiger cat sitting atop my head" class="nav__avatar"/>
    </a>
    <a href="#" class="nav__link">Login</a>
    <div class="nav__menu js">
        <button type="button" class="nav__button">Menu</button>
        <x-common::tooltip class="nav__tooltip">
            <x-common::tooltip-item icon="house" :href="route('home')" text="Home"/>
            <x-common::tooltip-item icon="pencil-scribble" href="#" text="Notes"/>
            <x-common::tooltip-item icon="bubble" href="#" text="Feed"/>
        </x-common::tooltip>
    </div>
    <div class="nav__menu no-js">
        <a class="nav__item" href="{{ route('home') }}">Home</a>
        <a class="nav__item" href="#">Notes</a>
        <a class="nav__item" href="#">Feed</a>
    </div>
</nav>
