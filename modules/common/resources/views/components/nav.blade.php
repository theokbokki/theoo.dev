<nav class="nav" data-focus-section="nav">
    <h2 class="sro">Main navigation</h2>
    <a href="#" class="nav__about" data-focus-ring>
        <span class="sro">Go to about page</span>
        <img src="{{ Vite::asset('modules/common/resources/images/avatar.png') }}" alt="Me in a hoodie with my tiger cat sitting atop my head" class="nav__avatar"/>
    </a>
    <a href="#" class="nav__link js" data-focus-ring>Login</a>
    <div class="nav__menu js">
        <button type="button" class="nav__button" data-focus-ring>Menu</button>
        <x-common::tooltip class="nav__tooltip">
            <x-common::tooltip-item icon="house" route="home" text="Home"/>
            <x-common::tooltip-item icon="pencil-scribble" route="notes" text="Notes"/>
            <x-common::tooltip-item icon="bubble" route="feed" text="Feed"/>
        </x-common::tooltip>
    </div>
    <div class="nav__menu no-js">
        <x-common::nav-item route="home" text="Home"/>
        <x-common::nav-item route="notes" text="Notes"/>
        <x-common::nav-item route="feed" text="Feed"/>
    </div>
</nav>
