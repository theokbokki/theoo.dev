<article class="player">
    <div class="player__head">
        <h2 class="player__status">Currently listening</h2>
        <span class="player__icon">@icon('ball')</span>
    </div>
    <div class="player__content">
        <figure class="player__cover">
            <img src="{{ Vite::asset('resources/images/mfdoom.jpg') }}" alt="ALL CAPS WHEN YOU SPELL THE MAN NAME">
        </figure>
        <div class="player__infos">
            <p class="player__title">All Caps</p>
            <p class="player__artists">Madvillain, MF DOOM, Madlib</p>
        </div>
    </div>
</article>

@pushOnce('styles')
<style>
    .player {
        padding: .5rem;
        width: calc(87.2vw - 1rem);
        width: calc(87.2dvw - 1rem);
        max-width: 25rem;
        background: rgb(var(--white));
        box-shadow: 0 0 0 1px rgb(var(--light-grey));
        border-radius: 0.375rem;
    }

    .player__head {
        display: flex;
        justify-content: space-between;
        margin-bottom: .25rem;
    }

    .player__status {
        font-family: var(--pixel);
        font-size: .875rem;
        line-height: 150%;
        text-transform: uppercase;
    }

    .player__icon {
        color: rgb(var(--orange));
    }

    .player__content {
        display: flex;
        gap: .5rem;
        padding: .5rem;
        background: rgb(var(--background));
        box-shadow: 0 0 0 1px rgb(var(--light-grey));
        border-radius: .25rem;
    }

    .player__infos {
        line-height: 150%;
        width: calc(100% - 3.5rem);
    }

    .player__cover {
        border-radius: .25rem;
        height: 3rem;
        width: 3rem;

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }

    .player__title {
        font-family: var(--pixel);
        text-transform: uppercase;
        color: rgb(var(--grey));
        overflow: hidden;
        text-wrap: nowrap;
        text-overflow: ellipsis;
        width: 100%;
    }

    .player__artists {
        font-size: .875rem;
        color: rgba(var(--grey), .5);
        overflow: hidden;
        text-wrap: nowrap;
        text-overflow: ellipsis;
        width: 100%;
    }
</style>
@endPushOnce
