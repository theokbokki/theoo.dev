<x-layout baseClass="posts">
    <header class="header">
        <h1 class="header__title">Edit post</h1>
        <x-nav/>
    </header>
    <form class="posts__form posts__form--edit" enctype="multipart/form-data">
        @csrf
        <div class="actions">
            <button type="submit" formaction="{{ route('posts.update', ['post' => $post]) }}" formmethod="POST" class="actions__action">Update</button>
            <div>
                <label for="attachments" class="actions__action">Add image</label>
                <input type="file" id="attachments" name="attachments[]" accept="image/*" multiple class="sro"/>
            </div>
        </div>
        <div class="posts__previews">
            @foreach($post->attachments as $attachment)
                <x-posts.preview file="/storage/posts/thumb/{{ $attachment->src }}.webp" :id="$attachment->id" :alt="$attachment->alt"/>
            @endforeach
        </div>
        <textarea id="content" name="content" class="posts__textarea" placeholder="Thoughts here...">{{ old('content', $post->content) }}</textarea>
        @error('content') <p class="posts__error">{{ $message }}</p> @enderror
    </form>
</x-layout>
