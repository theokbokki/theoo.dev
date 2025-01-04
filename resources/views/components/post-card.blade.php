<article class="post-card">
    <h3 class="post-card__title">
        <a
            href="{{ $post->link }}"
            @isset($post->external) target="_blank"
            @else data-transition="true"
            @endisset
            class="post-card__link"
        >
            {{ $post->title }}
            @isset($post->external)
                <span class="post-card__icon">@icon('arrow-up-right')</span>
            @endisset
        </a>
    </h3>
    <p class="post-card__text">{{ $post->excerpt }}</p>
</article>
