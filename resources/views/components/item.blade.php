<article class="item">
    <h3 class="item__title"><a href="{{ $href }}" class="item__link">{{ $title }}</a></h3>
    <p class="item__text">{{ $text }}</p>
</article>

@pushOnce('styles')
<style>
    .item {
        line-height: 150%;
        position: relative;

        @media screen and (min-width: 45rem) {
            display: flex;
            justify-content: space-between;
        }

        @media screen and (min-width: 60rem) {
            display: block;
        }
    }

    .item + .item {
        margin-top: 2rem;
    }

    .item__title {
        margin-bottom: .25rem;
        line-height: 150%;
        display: flex;
        align-items: center;
        flex: 1;

        @media screen and (min-width: 45rem) {
            &:after {
                content: "";
                height: 1px;
                flex: 1;
                background: rgb(var(--light-grey));
                margin: 0 .5rem;
            }
        }

        @media screen and (min-width: 60rem) {
            &:after {
                content: none;
            }
        }
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

        @media screen and (min-width: 45rem) {
            text-decoration-color: transparent;
        }

        @media screen and (min-width: 60rem) {
            text-decoration-color: rgba(var(--grey), .3);
        }
    }

    .item__text {
        color: rgba(var(--grey), .7);
    }
</style>
@endPushOnce
