<nav>
    <div>
        <h2>
            <a href="{{ route('home') }}">
                <span class="sr-only">{{ __('nav.title') }}</span>
                <span><x-icon-logo/></span>
            </a>
        </h2>
        <button type="button">
            <span class="sr-only">{{ __('nav.toggle') }}</span>
            <span><x-icon-nav-toggle/></span>
        </button>
    </div>
    <x-nav-section :title="__('nav.pages.title')">
        <x-nav-link :href="route('home')"
            :content="__('nav.pages.home')"
            icon="home"
        />
        <x-nav-link href="#"
            :content="__('nav.pages.links')"
            icon="link"
        />
        <x-nav-link href="#"
            :content="__('nav.pages.writings')"
            icon="book"
        />
        <x-nav-link href="#"
            :content="__('nav.pages.snippets')"
            icon="code"
        />
        <x-nav-link href="#"
            :content="__('nav.pages.trinkets')"
            icon="image"
        />
        <x-nav-link href="#"
            :content="__('nav.pages.recipes')"
            icon="pot"
        />
        <x-nav-link href="#"
            :content="__('nav.pages.shaders')"
            icon="circles"
        />
    </x-nav-section>
    <x-nav-section :title="__('nav.socials.title')">
        <x-nav-link href="#"
            :content="__('nav.socials.email')"
            icon="email"
        />
        <x-nav-link href="#"
            :content="__('nav.socials.github')"
            icon="github"
        />
        <x-nav-link href="#"
            :content="__('nav.socials.twitter')"
            icon="twitter"
        />
        <x-nav-link href="#"
            :content="__('nav.socials.instagram')"
            icon="instagram"
        />
    </x-nav-section>
</nav>
