<x-common::layout baseClass="note">
    @push('styles')
        @vite(['modules/notes/resources/css/notes.scss'])
    @endpush

    <header class="note__header">
        <h1 class="note__title">{{ $note->frontmatter['title'] }}</h1>
        <x-common::nav/>
    </header>
    <form class="actions">
        @csrf
        <a href="{{ route('notes.edit', ['slug' => $note->frontmatter['slug']]) }}" class="actions__action">Edit note</a>
    </form>
    <div class="note__content">{!! $note->html !!}</div>
</x-common::layout>
