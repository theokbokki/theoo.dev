<x-layout baseClass="note">
    <header class="header">
        <h1 class="header__title">Notes</h1>
        <x-nav/>
    </header>
    <form class="actions">
        @csrf
        <button type="submit" formaction="{{ route('notes.create') }}" formmethod="POST" class="actions__action">New note</button>
    </form>
    <main class="prose">
        @isset($notes['published'])
            <ul>
                @foreach($notes['published'] as $note)
                    <li>
                        <a href="{{ route('notes.show', ['slug' => $note->slug]) }}">{{ $note->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endisset

        @isset($notes['draft'])
            <ul>
                @foreach($notes['draft'] as $note)
                    <li>
                        <a href="{{ route('notes.show', ['slug' => $note->slug]) }}">{{ $note->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endisset
    </main>
</x-layout>
