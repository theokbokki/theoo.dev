<section class="intro">
    <h2 class="intro__title">
        @lang('home.intro.title')
    </h2>
    <p class="intro__text">
        @lang('home.intro.text')
    </p>
</section>

@pushOnce('styles')
<style>
    .intro {
        width: 16rem;
        line-height: 150%;
    }

    .intro__title {
        margin-bottom: .25rem;
    }
</style>
@endPushOnce
