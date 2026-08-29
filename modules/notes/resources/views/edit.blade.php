<x-common::layout baseClass="note">
    @push('styles')
        @vite(['modules/notes/resources/css/notes.scss'])
    @endpush

    <h1 class="sro">Edit: {{ $note->frontmatter['title'] }}</h1>
    <x-common::nav/>
</x-common::layout>
