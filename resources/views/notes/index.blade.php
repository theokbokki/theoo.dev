<x-layout base-class="notes">
    <header class="notes__header">
        <h1 class="notes__title">Notes</h1>
        <x-nav/>
    </header>
    <hr class="notes__divider">
    <main class="notes__list">
        @foreach($notes as $note)
            <article class="notes__card note-card">
                <h3 class="note-card__title">
                    <a href="#" class="note-card__link">{{ $note->title }}</a>
                </h3>
                <p class="note-card__subtitle">{{ $note->subtitle }}</p>
            </article>
        @endforeach
    </main>
</x-layout>
