<x-layout base-class="links">
    <header class="links__header">
        <x-nav/>
        <h1 class="links__title">Links</h1>
        <p class="links__intro">Saving stuff I come across online for later.</p>
        <div class="links__tags">
            @foreach($tags as $tag)
                <a
                    href="{{ route('links.index', ['tag' => $tag->slug]) }}"
                    class="links__tag {{ $tag->slug === $current ? 'links__tag--current' : null }}"
                >
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </header>
    <main class="links__main">
        <ul class="links__list">
            @foreach($links as $link)
                <li class="links__item">
                    <a href="{{ $link->url }}" class="links__link" target="_blank">
                        <img src="/storage/{{ $link->getImage }}" alt="" class="links__favicon"/>
                        <span class="links__url">{{ str($link->url)->chopStart(['https://', 'http://'])->chopStart('www.')->chopEnd('/') }}</span>
                    </a>
                    <p class="links__description">{{ $link->description }}</p>
                </li>
            @endforeach
        </ul>
    </main>
    <footer class="links__footer">
        <a href="#" class="links__top">Back to top ↑</a>
    </footer>
</x-layout>
