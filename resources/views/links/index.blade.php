<x-layout baseClass="links">
    <header class="header">
        <h1 class="header__title">Links</h1>
        <x-nav/>
    </header>
    <form class="actions">
        @csrf
        <a href="{{ route('links.draft') }}" class="actions__action">Add link</a>
    </form>
    <main class="links__table">
        @foreach($links as $link)
            <div class="links__link">
                <img alt="" src="/storage/{{ $link->favicon }}" class="links__favicon"/>
                <a href="{{ $link->url }}" class="links__url" target="_blank">{!! preg_replace('~([/.?#&=_-])~', '$1<wbr>', $link->url) !!}</a>
                <p class="links__description">{{ $link->description }}</p>
            </div>
        @endforeach
    </main>
</x-layout>
