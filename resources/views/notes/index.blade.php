<x-layout>
    <header>
        <h1>Notes</h1>
        <x-nav/>
    </header>
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
