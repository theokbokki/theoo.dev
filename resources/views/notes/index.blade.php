<x-layout base-class="notes">
    <header class="notes__header">
        <h1 class="notes__title">Notes</h1>
        <x-nav/>
        <p class="notes__intro">This is my notes page. It’s basically a blog but where I write like I would in a notes app. I don’t perfect or re-read or anything. I just say whatever I have in mind and try to write it down so it makes sense.</p>
        <p class="notes__intro">You might find something interesting, who knows!</p>
    </header>
    <hr class="notes__divider">
    <main class="notes__list">
        @foreach($notes as $note)
            <article class="notes__card note-card">
                <h3 class="note-card__title">
                    <a href="{{ route('notes.show', ['note' => $note]) }}" class="note-card__link">{{ $note->title }}</a>
                </h3>
                @isset($note->subtitle)
                    <p class="note-card__subtitle">{{ $note->subtitle }}</p>
                @endisset
            </article>
        @endforeach
    </main>
    <x-note-backdrop/>
</x-layout>
