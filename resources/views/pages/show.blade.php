<x-layout baseClass="page">
    <x-nav/>
    @isset ($page->parent)
        <a href="{{ $page->parent->url() }}" class="page__back">← Back</a>
    @endisset

    <h1 class="page__title">{{ $page->title }}</h1>

    <main class="page__content">
        {!! str($page->content)->markdown()->sanitizeHtml() !!}
    </main>
</x-layout>
