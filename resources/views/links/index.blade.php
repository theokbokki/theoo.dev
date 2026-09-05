<x-layout baseClass="links">
    <header class="header">
        <h1 class="header__title">Links</h1>
        <x-nav/>
    </header>

    <main class="links__table">
        @foreach($links as $link)
            <div class="links__link">
                <img alt="" src="/storage/{{ $link->favicon }}" class="links__favicon"/>
                <a href="{{ $link->url }}" class="links__url" target="_blank">{{ $link->url }}</a>
                <p class="links__description">{{ $link->description }}</p>
            </div>
        @endforeach
    </main>
</x-layout>
