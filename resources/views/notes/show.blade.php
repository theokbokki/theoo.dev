<x-layout>
    <header>
        <h1>{{ $note->title }}</h1>
        <x-nav/>
    </header>
    <form class="actions">
        @csrf
        <a href="{{ route('notes.edit', ['slug' => $note->slug]) }}" class="actions__action">Edit note</a>
    </form>
    <main>
        {!! $note->content !!}
    </main>
</x-layout>
