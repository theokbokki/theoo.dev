<x-layout baseClass="note">
    <header class="header">
        <h1 class="header__title">{{ $note->title }}</h1>
        <x-nav/>
    </header>
    <form class="actions">
        @csrf
        <a href="{{ route('notes.edit', ['slug' => $note->slug]) }}" class="actions__action">Edit note</a>
        <button type="submit" formaction="{{ route('notes.status', ['slug' => $note->slug]) }}" formmethod="POST" class="actions__action">{{ $note->status->label() }}</button>
    </form>
    <main class="prose">
        {!! $note->content !!}
    </main>
</x-layout>
