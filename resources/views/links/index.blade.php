<x-layout base-class="links">
    <header class="links__header">
        <h1 class="links__title">Links</h1>
        <x-nav/>
        <p class="links__intro">A place to share and bookmark websites, articles, recipes and all other internet stuff I like.</p>
    </header>
    <main class="links__main">
        @foreach($linksByCategory as $category => $links)
            <details class="links__group" open>
                <summary class="links__label">{{ $category }}</summary>
                <ul class="links__list">
                    @foreach($links as $link)
                    <li class="links__item">
                        <a href="{{ $link->url }}" class="links__link" target="_blank">
                            <img src="storage/{{ $link->favicon }}" alt="" class="links__favicon"/>
                            <span class="links__url">{{ str($link->url)->chopStart(['https://', 'http://'])->chopStart('www.')->chopEnd('/') }}</span>
                        </a>
                        <p class="links__description">{{ $link->description }}</p>
                    </li>
                    @endforeach
                </ul>
            </details>
        @endforeach
    </main>
    <footer class="links__footer">
        <a href="#" class="links__top">Back to top ↑</a>
    </footer>
</x-layout>
