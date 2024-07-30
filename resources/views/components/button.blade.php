<a href="{{ $href }}"
    data-color="{{ $color }}"
    class="button"
    @isset($external)
        target="_blank"
    @endisset
>
    @isset($icon)
        <span class="button__icon">
            @icon($icon)
        </span>
    @endisset

    {{ $slot }}
</a>

@pushOnce('styles')
<style>
    .button {
        display: flex;
        width: max-content;
        height: max-content;
        padding: 0.375rem .5rem .25rem;
        font-family: var(--pixel);
        font-size: 1rem;
        text-decoration: none;
        text-transform: uppercase;
        color: rgb(var(--white));
        border-radius: .25rem;
        transition: transform 100ms ease-out,
            box-shadow 200ms ease-out,
            filter 200ms ease-out;

        &:hover {
            filter: brightness(150%);
        }

        &:focus-visible,
        &:active {
            transform: scale(.95);
            outline: none;
        }
    }

    .button:has(.button__icon) {
        padding: 0;
        width: 1.5rem;
        height: 1.5rem;
    }

    .button[data-color=orange] {
        background: rgb(var(--orange));

        &:focus-visible {
            box-shadow: 0 0 0 2px rgba(var(--orange), .5)
        }
    }

    .button[data-color=black] {
        background: rgb(var(--black));

        &:hover {
            filter: brightness(200%);
        }

        &:focus-visible {
            box-shadow: 0 0 0 2px rgba(var(--black), .5)
        }
    }

    .button[data-color=light-grey] {
        background: rgb(var(--light-grey));
        color: rgb(var(--black));

        &:hover {
            filter: brightness(105%);
        }

        &:focus-visible {
            box-shadow: 0 0 0 2px rgba(var(--lightgray), .5)
        }
    }

    .button__icon {
        display: inline-block;
        width: 1rem;
        height: 1rem;
        margin: auto;

        svg {
            width: 100%;
            height: 100%;
        }
    }
</style>
@endPushOnce
