<x-common::layout baseClass="note">
    @push('styles')
        @vite(['modules/notes/resources/css/notes.scss'])
    @endpush

    <header class="note__header">
        <h1 class="note__title">{{ $note->frontmatter['title'] }}</h1>
        <x-common::nav/>
    </header>
    <div class="note__content">{!! $note->html !!}</div>
</x-common::layout>
