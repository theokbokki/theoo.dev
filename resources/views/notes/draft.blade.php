<x-layout baseClass="notes">
    <header class="header">
        <h1 class="header__title">New note</h1>
        <x-nav/>
    </header>
    <form class="notes__form notes__form--draft">
        @csrf
        <div class="actions">
            <button type="submit" formaction="{{ route('notes.create') }}" formmethod="POST" class="actions__action">Save</button>
            <div>
                <label for="upload-image" class="actions__action">Add image</button>
                <input type="file" name="upload-image" id="upload-image" accept="image/*" hidden multiple/>
            </div>
        </div>
        <textarea name="content" id="content" class="notes__edit" placeholder="Blablabla...">{!! old('content') !!}</textarea>
        @error('content') <p class="note__error">{{ $message }}</p> @enderror
    </form>
</x-layout>
