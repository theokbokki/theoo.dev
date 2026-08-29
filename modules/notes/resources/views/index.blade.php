<x-common::layout baseClass="notes">
    <h1 class="notes__title">Notes</h1>
    <ul>
        @foreach($notes as $note)
            <li>
                <a href="{{ $note->url }}">{{ $note->title }}</a>
            </li>
        @endforeach
    </ul>
</x-common::layout>
