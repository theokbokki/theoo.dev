<x-layout baseClass="posts">
    <header class="header">
        <h1 class="header__title">New post</h1>
        <x-nav/>
    </header>
    <form class="posts__form posts__form--draft" enctype="multipart/form-data">
        @csrf
        <div class="actions">
            <button type="submit" formaction="{{ route('posts.create') }}" formmethod="POST" class="actions__action">Save</button>
            <div>
                <label for="attachments" class="actions__action">Add image</label>
                <input type="file" id="attachments" name="attachments[]" accept="image/*" multiple class="sro"/>
            </div>
        </div>
        <div class="posts__previews"></div>
        <textarea id="content" name="content" class="posts__textarea" placeholder="Thoughts here...">{{ old('content') }}</textarea>
        @error('content') <p class="posts__error">{{ $message }}</p> @enderror
    </form>
</x-layout>
