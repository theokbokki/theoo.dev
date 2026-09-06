<x-layout baseClass="links">
    <header class="header">
        <h1 class="header__title">Edit link</h1>
        <x-nav/>
    </header>
    <form action="{{ route('links.update', ['link' => $link]) }}" method="POST" class="links__form">
        @csrf
        <div class="links__field">
            <label for="url" class="links__label">Url</label>
            <input type="url" id="url" name="url" class="links__input" value="{{ old('url', $link->url) }}"/>
            @error('url') <p class="links__error">{{ $message }}</p> @enderror
        </div>
        <div class="links__field">
            <label for="description" class="links__label" >Description</label>
            <input type="text" id="description" name="description" class="links__input" value="{{ old('description', $link->description) }}"/>
            @error('description') <p class="links__error">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="links__submit">Edit link</button>
    </form>
</x-layout>
