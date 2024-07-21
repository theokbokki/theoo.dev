<article class="item">
    <h3 class="item__title"><a href="{{ $href }}" class="item__link">{{ $title }}</a></h3>
    <p class="item__text">{{ $text }}</p>
</article>

@pushOnce('styles')
<style>
    .item {
        line-height: 150%;
        position: relative;
    }

    .item + .item {
        margin-top: 2rem;
    }

    .item__title {
        margin-bottom: .25rem;
        line-height: 150%;
    }

    .item__link {
        color: rgb(var(--black));
        text-decoration-color: rgba(var(--grey), .3);
        text-underline-offset: .25rem;
        transition: text-decoration-color 200ms ease-out;

        &:hover {
            text-decoration-color: rgb(var(--black));
        }

        &:before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
    }

    .item__text {
        color: rgba(var(--grey), .7);
    }
</style>
@endPushOnce
