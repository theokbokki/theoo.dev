<x-layout baseClass="page">
    <style>
        :root {
            --hue: {{ rand(0, 360) }}deg
        }
    </style>
    <x-nav/>
    @isset ($page->parent)
        <a href="{{ $page->parent->url() }}" class="page__back">← Back</a>
    @endisset

    <h1 class="page__title">{{ $page->title }}</h1>

    @if($page->children->count())
        <details class="page__subpages">
            <summary class="page__subtitle">
                <span>Subpages</span>
                <x-icon name="chevron"/>
            </summary>
            <hr class="page__divider"/>
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
