<x-layout baseClass="notes">
    <header class="header">
        <h1 class="header__title">Edit note "{{ $note->title }}"</h1>
        <a href="{{ route('notes.show', ['note' => $note]) }}" class="header__back">← Back to note</a>
        <x-nav/>
    </header>
    <form class="notes__form notes__form--edit">
        @csrf
        <div class="actions">
            <button type="submit" formaction="{{ route('notes.update', ['note' => $note]) }}" formmethod="POST" class="actions__action">Save</button>
            <div>
                <label for="upload-image" class="actions__action">Add image</button>
                <input type="file" name="upload-image" id="upload-image" accept="image/*" hidden multiple/>
            </div>
            <button type="submit" formaction="{{ route('notes.delete', ['note' => $note]) }}" formmethod="POST" class="actions__action actions__action--danger">Delete</button>
        </div>
        <textarea name="content" id="content" placeholder="Blablabla..." class="notes__edit">{!! old('content', $note->content) !!}</textarea>
        @error('content') <p class="notes__error">{{ $message }}</p> @enderror
    </form>
</x-layout>
