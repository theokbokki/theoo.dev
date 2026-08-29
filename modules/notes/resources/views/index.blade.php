<x-common::layout baseClass="notes">
    @push('styles')
        @vite(['modules/notes/resources/css/notes.scss'])
    @endpush
    <h1 class="sro">Notes</h1>
    <x-common::nav/>
    <form class="actions">
        @csrf
        <button formaction="{{ route('notes.create') }}" formmethod="POST" class="actions__action">New note</button>
    </form>
    <div class="notes__content">
        <p class="notes__text">These are my notes! It’s basically a blog but where I write like I  would in a notes app. I don’t correct or re-read or anything. I just say whatever I have in mind and try to write it down so it makes sense.</p>
        <br/>
        <p class="notes__text">You might find something interesting, who knows!</p>
    </div>
    <ul class="notes__list">
        @foreach($notes as $note)
            <li class="notes__item">
                <a href="{{ $note->url }}" class="notes__link">{{ $note->title }}</a>
            </li>
        @endforeach
    </ul>
</x-common::layout>
