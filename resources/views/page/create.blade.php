<x-base>
    <h1 class="form__title">Create page</h1>
    <form action="{{ route('page.store') }}" method="POST" class="form">
        @csrf
        <input type="hidden" value="{{ $parentId }}" name="parent_id" id="parent_id" />
        <div class="form__field">
            <label for="title" class="form__label">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form__input">
            @error('title') <p class="form__error">{{ $message }}</p> @enderror
        </div>
        @error('parent_id') <p class="form__error">{{ $message }}</p> @enderror
        <button type="submit" class="form__button">Create page</button>
    </form>
</x-base>
