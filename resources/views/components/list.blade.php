<section class="list">
    <h2 class="list__title">{{ $title }}</h2>
    <div class="list__items">
        {{ $slot }}
    </div>
    <x-button color="light-grey" :$href>
        {{ $button }}
    </x-button>
</section>

@pushOnce('styles')
<style>
    .list {
        display: grid;
        row-gap: 2rem;

        @media screen and (min-width: 45rem) {
            grid-column: 1/-1;
        }

        @media screen and (min-width: 60rem) {
            grid-column: unset;
        }
    }

    .list__title {
        font-family: var(--pixel);
        text-transform: uppercase;
    }
</style>
@endPushOnce
