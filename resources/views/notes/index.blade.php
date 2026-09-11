<x-layout baseClass="notes">
    <header class="header">
        <h1 class="header__title">Notes</h1>
        <x-nav/>
    </header>
    @auth()
    <form class="actions">
        @csrf
        <a href="{{ route('notes.draft') }}" class="actions__action">New note</a>
    </form>
    @endauth
    <main class="prose">
            <ul>
                @foreach($notes['published'] as $note)
                    <li>
                        <a href="{{ route('notes.show', ['note' => $note]) }}">{{ $note->title }}</a>
                    </li>
                @endforeach
            </ul>

        @auth()
            @isset($notes['draft'])
                <ul>
                    @foreach($notes['draft'] as $note)
                        <li>
                            <a href="{{ route('notes.show', ['note' => $note]) }}">{{ $note->title }}</a>
                        </li>
                    @endforeach
                </ul>
            @endisset
        @endauth
    </main>
</x-layout>
