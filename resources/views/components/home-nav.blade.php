<x-nav>
    <x-slot name="left">
        <div>
            <a href="{{ LaravelLocalization::localizeUrl(route('home')) }}"
                class="nav__logo"
            >
                <span class="sro">@lang('home.home-link')</span>
                @icon('logo')
            </a>
        </div>
    </x-slot>

    <x-slot name="right">
        <div class="nav__contact">
            <x-button color="orange"
                href="mailto:{{ env('MAIL_FROM_ADDRESS') }}"
            >
                @lang('home.email')
            </x-button>

            <x-button color="black"
                icon="github"
                href="https://github.com/theokbokki"
                external
            >
                <span class="sro">Github</span>
            </x-button>

            <x-button color="black"
                icon="x"
                href="https://x.com/theokbokki_"
                external
            >
                <span class="sro">X (Twitter)</span>
            </x-button>
        </div>
    </x-slot>
</x-nav>

@pushOnce('styles')
<style>
    .nav__logo {
        display: inline-block;
        color: rgb(var(--black));
        text-decoration: none;
        height: 1rem;

        svg {
            width: 100%;
            height: 100%;
        }
    }

    .nav__contact {
        display: flex;
        gap: .5rem;
        align-items: center;
        justify-content: end;
    }
</style>
@endPushOnce
