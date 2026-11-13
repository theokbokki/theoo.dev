<x-layout baseClass="page">
    <x-nav/>

    @isset ($page->parent)
        <a href="{{ $page->parent->url() }}" class="page__back">← Back</a>
    @endisset

    <div aria-hidden="true" class="page__theme">
        <button type="button" class="page__toggle" data-theme="amber">Amber</button>
        <button type="button" class="page__toggle" data-theme="green">Green</button>
        <button type="button" class="page__toggle" data-theme="cyan">Cyan</button>
        <button type="button" class="page__toggle" data-theme="magenta">Magenta</button>
    </div>

    <h1 class="page__title">{{ $page->title }}</h1>

    @if($page->children->count())
        <details class="page__subpages">
            <summary class="page__subtitle">
                <span>Subpages</span>
                <x-icon name="chevron"/>
            </summary>
            <ul class="page__list">
                @foreach($page->children as $child)
                    <li class="page__item">
                        <a href="{{ $child->url() }}" class="page__subpage">{{ $child->title }}</a>
                    </li>
                @endforeach
            </ul>
        </details>
    @endif

    <main class="page__content">
        {!! str($page->content)->markdown()->sanitizeHtml() !!}
    </main>
</x-layout>
