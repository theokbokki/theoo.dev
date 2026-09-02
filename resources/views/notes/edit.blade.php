<x-layout>
    <header>
        <h1>Edit note "{{ $note->title }}"</h1>
        <a href="{{ route('notes.show', ['slug' => $note->slug]) }}">← Back to note</a>
        <x-nav/>
    </header>
    <form action="{{ route('notes.update', ['slug' => $note->slug]) }}" method="POST">
        <div class="actions">
            <button type="submit" class="actions__action">Save</button>
        </div>
        <textarea name="content" id="content" class="note__content">{!! old('content', $note->content) !!}</textarea>
        @error('content') <p class="note__error">{{ $message }}</p> @enderror
    </form>
</x-layout>
