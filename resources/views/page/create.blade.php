<x-base title="Create page">
    <h1 class="form__title">Create page</h1>
    <form action="{{ route('page.store') }}" method="POST" class="form">
        @csrf
        <input type="hidden" value="{{ $parentId }}" name="parent_id" id="parent_id" />
        <div class="form__field">
            <label for="title" class="form__label">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form__input">
            @error('title') <p class="form__error">{{ $message }}</p> @enderror
        </div>
        <div class="form__field form__field--checkbox">
            <label for="draft" class="form__label form__label--checkbox">Draft</label>
            <input type="hidden" name="draft" value="0"/>
            <input type="checkbox" name="draft" id="draft" value="1" @checked(old('draft', true)) class="form__input form__input--checkbox"/>
            @error('draft') <p class="form__error">{{ $message }}</p> @enderror
        </div>
        <div class="form__field form__field--checkbox">
            <label for="private" class="form__label form__label--checkbox">Private</label>
            <input type="hidden" name="private" value="0"/>
            <input type="checkbox" name="private" id="private" value="1" @checked(old('private', true)) class="form__input form__input--checkbox"/>
            @error('private') <p class="form__error">{{ $message }}</p> @enderror
        </div>
        <div class="form__field form__field--checkbox">
            <label for="pinned" class="form__label form__label--checkbox">Pinned</label>
            <input type="hidden" name="pinned" value="0"/>
            <input type="checkbox" name="pinned" id="pinned" value="1" @checked(old('pinned', false)) class="form__input form__input--checkbox"/>
            @error('pinned') <p class="form__error">{{ $message }}</p> @enderror
        </div>
        @error('parent_id') <p class="form__error">{{ $message }}</p> @enderror
        <button type="submit" class="form__button">Create page</button>
    </form>
</x-base>
