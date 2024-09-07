<article class="post">
    <h3 class="post__title">
        <a
            href="{{ $post->link }}"
            @if($post->external) target="_blank" @endif
            class="post__link"
        >
            {{ $post->title }}
            @if($post->external)
                <span class="post__icon">@icon('arrow-up-right')</span>
            @endif
        </a>
    </h3>
    <p class="post__text">{{ $post->excerpt }}</p>
</article>
