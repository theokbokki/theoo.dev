<x-layout baseClass="notes">
    <header class="header">
        <h1 class="header__title">{{ $note->title }}</h1>
        <x-nav/>
    </header>
    @auth()
    <form class="actions">
        @csrf
        <a href="{{ route('notes.edit', ['note' => $note]) }}" class="actions__action">Edit note</a>
        <button type="submit" formaction="{{ route('notes.status', ['note' => $note]) }}" formmethod="POST" class="actions__action">{{ $note->status->label() }}</button>
    </form>
    @endauth
    <main class="prose">
        {!! $note->content !!}
    </main>
</x-layout>
