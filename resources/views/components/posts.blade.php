<section class="posts">
    <h2 class="posts__title">{{ $title }}</h2>
    @foreach ($posts as $post)
        <x-post :$post />
    @endforeach
    @if($posts->count() === 3)
    <div class="posts__button">
        <x-button
            :content="$button"
            :href="LaravelLocalization::localizeUrl(route($type))"
        />
    </div>
    @endif
</section>
