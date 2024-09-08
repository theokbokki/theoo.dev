<article class="post-card">
    <h3 class="post-card__title">
        <a
            href="{{ $post->link }}"
            @if($post->external) target="_blank" @endif
            class="post-card__link"
        >
            {{ $post->title }}
            @if($post->external)
                <span class="post-card__icon">@icon('arrow-up-right')</span>
            @endif
        </a>
    </h3>
    <p class="post-card__text">{{ $post->excerpt }}</p>
</article>
