<x-base title="Edit page">
    <h1 class="form__title">Edit page</h1>
    <form action="{{ route('page.update', ['id' => $page->id]) }}" method="POST" class="form">
        @csrf
        <div class="form__field">
            <label for="title" class="form__label">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') ?? $page->title }}" class="form__input">
            @error('title') <p class="form__error">{{ $message }}</p> @enderror
        </div>
        <div class="form__field form__field--checkbox">
            <label for="draft" class="form__label form__label--checkbox">Draft</label>
            <input type="hidden" name="draft" value="0"/>
            <input type="checkbox" name="draft" id="draft" value="1" @checked(old('draft', $page->draft)) class="form__input form__input--checkbox"/>
            @error('draft') <p class="form__error">{{ $message }}</p> @enderror
        </div>
        <div class="form__field form__field--checkbox">
            <label for="private" class="form__label form__label--checkbox">Private</label>
            <input type="hidden" name="private" value="0"/>
            <input type="checkbox" name="private" id="private" value="1" @checked(old('private', $page->private)) class="form__input form__input--checkbox"/>
            @error('private') <p class="form__error">{{ $message }}</p> @enderror
        </div>
        <div class="form__field form__field--checkbox">
            <label for="pinned" class="form__label form__label--checkbox">Pinned</label>
            <input type="hidden" name="pinned" value="0"/>
            <input type="checkbox" name="pinned" id="pinned" value="1" @checked(old('pinned', $page->pinned)) class="form__input form__input--checkbox"/>
            @error('pinned') <p class="form__error">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="form__button">Edit</button>
    </form>
</x-base>
