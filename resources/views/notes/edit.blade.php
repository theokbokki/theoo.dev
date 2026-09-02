<x-layout>
    <header>
        <h1>Edit note "{{ $note->title }}"</h1>
        <a href="{{ route('notes.show', ['slug' => $note->slug]) }}">← Back to note</a>
        <x-nav/>
    </header>
    <form>
        @csrf
        <div class="actions">
            <button type="submit" formaction="{{ route('notes.update', ['slug' => $note->slug]) }}" formmethod="POST" class="actions__action">Save</button>
            <button type="submit" formaction="{{ route('notes.delete', ['slug' => $note->slug]) }}" formmethod="POST" class="actions__action actions__action--danger">Delete</button>
        </div>
        <textarea name="content" id="content" class="note__content">{!! old('content', $note->content) !!}</textarea>
        @error('content') <p class="note__error">{{ $message }}</p> @enderror
    </form>
</x-layout>
