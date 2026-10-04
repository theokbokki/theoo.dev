<x-layout base-class="note">
    <header class="note__header">
        <h1 class="note__title">{{ $note->title }}</h1>
        <x-nav/>
        <a href="{{ route('notes.index') }}" class="note__back">← Back to index</a>
        @isset($note->subtitle)
            <p class="note__intro">{{ $note->subtitle }}</p>
        @endisset
    </header>
    <hr class="note__divider">
    <main class="note__content">
        {!! str($note->content)->markdown()->sanitizeHtml() !!}
    </main>
    <x-note-backdrop/>
</x-layout>
