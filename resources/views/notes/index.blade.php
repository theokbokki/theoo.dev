<x-layout baseClass="notes">
    <h1 class="sro">Notes</h1>
    <x-nav>
        @auth()
            <x-slot:actions>
                <x-button :href="route('notes.draft')" title="New note" modifiers="icon secondary" icon="plus"/>
            </x-slot>
        @endauth
    </x-nav>
    <main class="notes__list">
        @foreach($notes as $note)
            <article class="note-card">
                <h3 class="note-card__title">
                    <a href="{{ route('notes.show', ['note' => $note]) }}" class="note-card__link">{{ $note->title }}</a>
                </h3>
                @isset($note->subtitle)
                    <p class="note-card__subtitle">{{ $note->subtitle }}</p>
                @endisset
            </article>
        @endforeach
    </main>
</x-layout>
