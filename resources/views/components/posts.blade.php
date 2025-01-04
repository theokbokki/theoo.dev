<section class="posts">
    <h2 class="posts__title">{{ $title }}</h2>
    @foreach ($posts as $post)
        <x-post-card :$post />
    @endforeach
    @if($posts->count() >= 3 && isset($button))
    <div class="posts__button">
        <x-button
            :content="$button"
            :href="LaravelLocalization::localizeUrl(route(str()->plural($posts->first()->type)))"
            data-transition="true"
        />
    </div>
    @endif
</section>
