<div class="absolute top-16 right-16 w-44 h-44 p-2 rounded-lg bg-linear-to-b from-neutral-100/60 to-neutral-200/60 border border-neutral-200/50 backdrop-blur-xs shadow-[0_20px_20px_-20px_rgba(231,229,228,0.75)] md:hidden" data-role="mobile-nav-open">
    <button type="button" class="h-full w-full flex items-center justify-center bg-white rounded-md border border-neutral-200 text-neutral-500 cursor-pointer">
        <span class="sr-only">{{ __('nav.toggle') }}</span>
        <span><x-icon-burger/></span>
    </button>
</div>
<div class="before:absolute before:inset-0 before:bg-neutral-200/20 before:blur-xs before:hidden before:transition-all before:duration-250 before:opacity-0" data-role="nav-container">
    <nav class="w-[calc(100%-2rem)] h-[calc(100%-2rem)] p-6 m-16 rounded-xl bg-linear-to-b from-neutral-100/60 to-neutral-200/60 border border-neutral-200/50 backdrop-blur-xs shadow-[0_20px_20px_-20px_rgba(231,229,228,0.75)] transition-all duration-250 md:max-w-296 md:flex-1" data-role="nav" data-state="closed">
        <div class="h-full px-12 py-20 bg-white rounded-md border border-neutral-200">
            <div class="flex justify-between items-center px-8">
                <h2>
                    <a href="{{ route('home') }}">
                        <span class="sr-only">{{ __('nav.title') }}</span>
                        <span><x-icon-logo/></span>
                    </a>
                </h2>
                <button type="button" class="cursor-pointer text-neutral-500">
                    <span class="sr-only">{{ __('nav.toggle') }}</span>
                    <span class="max-md:hidden" data-role="nav-toggle"><x-icon-nav-toggle/></span>
                    <span class="md:hidden" data-role="mobile-nav-close"><x-icon-close/></span>
                </button>
            </div>
            <x-nav-section :title="__('nav.pages.title')">
                <x-nav-link :href="route('home')"
                    :content="__('nav.pages.home')"
                    icon="home"
                />
                <x-nav-link href="/temp"
                    :content="__('nav.pages.links')"
                    icon="link"
                />
                <x-nav-link href="/temp"
                    :content="__('nav.pages.writings')"
                    icon="book"
                />
                <x-nav-link href="/temp"
                    :content="__('nav.pages.snippets')"
                    icon="code"
                />
                <x-nav-link href="/temp"
                    :content="__('nav.pages.trinkets')"
                    icon="image"
                />
                <x-nav-link href="/temp"
                    :content="__('nav.pages.recipes')"
                    icon="pot"
                />
                <x-nav-link href="/temp"
                    :content="__('nav.pages.shaders')"
                    icon="circles"
                />
            </x-nav-section>
            <x-nav-section :title="__('nav.socials.title')">
                <x-nav-link href="/temp"
                    :content="__('nav.socials.email')"
                    icon="email"
                />
                <x-nav-link href="/temp"
                    :content="__('nav.socials.github')"
                    icon="github"
                />
                <x-nav-link href="/temp"
                    :content="__('nav.socials.twitter')"
                    icon="twitter"
                />
                <x-nav-link href="/temp"
                    :content="__('nav.socials.instagram')"
                    icon="instagram"
                />
            </x-nav-section>
        </div>
    </nav>
</div>
