<x-layout>
    <header>
        <h1>Notes</h1>
        <x-nav/>
    </header>
    <main>
        <ul>
            @foreach($notes['published'] as $note)
                <li>
                    <a href="#">{{ $note->title }}</a>
                </li>
            @endforeach
        </ul>

        <ul>
            @foreach($notes['draft'] as $note)
                <li>
                    <a href="#">{{ $note->title }}</a>
                </li>
            @endforeach
        </ul>
    </main>
</x-layout>
