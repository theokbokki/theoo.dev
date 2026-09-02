<x-layout>
    <header>
        <h1>Notes</h1>
        <x-nav/>
    </header>
    <form class="actions">
        <button type="submit" formaction="{{ route('notes.create') }}" formmethod="POST" class="actions__action">New note</button>
    </form>
    <main>
        @foreach($notes as $group)
            <ul>
                @foreach($group as $note)
                    <li>
                        <a href="{{ route('notes.show', ['slug' => $note->slug]) }}">{{ $note->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </main>
</x-layout>
