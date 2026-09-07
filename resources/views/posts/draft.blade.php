<x-layout baseClass="posts">
    <header class="header">
        <h1 class="header__title">New post</h1>
        <x-nav/>
    </header>
    <form class="posts__form posts__form--draft">
        @csrf
        <div class="actions">
            <button type="submit" formaction="#" formmethod="POST" class="actions__action">Save</button>
            <div>
                <button type="button" class="actions__action" data-action="attachments">Add image</button>
                <input type="file" id="attachments" name="attachments" accept="image/*" hidden multiple/>
            </div>
        </div>
        <textarea id="content" name="content" class="posts__textarea" value="{{ old('content') }}" placeholder="Thoughts here..."></textarea>
        @error('content') <p class="posts__error">{{ $message }}</p> @enderror
    </form>
</x-layout>
