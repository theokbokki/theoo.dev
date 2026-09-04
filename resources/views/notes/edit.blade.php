<x-layout baseClass="note">
    <header class="header">
        <h1 class="header__title">Edit note "{{ $note->title }}"</h1>
        <a href="{{ route('notes.show', ['slug' => $note->slug]) }}" class="header__back">← Back to note</a>
        <x-nav/>
    </header>
    <form id="edit-note">
        @csrf
        <div class="actions">
            <button type="submit" formaction="{{ route('notes.update', ['slug' => $note->slug]) }}" formmethod="POST" class="actions__action">Save</button>
            <div>
                <button type="button" class="actions__action" id="upload-image-btn">Add image</button>
                <input type="file" id="upload-image-input" accept="image/*" hidden multiple/>
            </div>
            <button type="submit" formaction="{{ route('notes.delete', ['slug' => $note->slug]) }}" formmethod="POST" class="actions__action actions__action--danger">Delete</button>
        </div>
        <textarea name="content" id="content" class="note__edit">{!! old('content', $note->content) !!}</textarea>
        @error('content') <p class="note__error">{{ $message }}</p> @enderror
    </form>
</x-layout>
