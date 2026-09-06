<x-layout baseClass="links">
    <header class="header">
        <h1 class="header__title">Add link</h1>
        <x-nav/>
    </header>
    <form action="route('link.create')" method="POST" class="links__form">
        @csrf
        <div class="links__field">
            <label for="url" class="links__label">Url</label>
            <input type="url" id="url" name="url" class="links__input" />
        </div>
        <div class="links__field">
            <label for="description" class="links__label" >Description</label>
            <input type="text" id="url" name="description" class="links__input" />
        </div>

        <button type="submit" class="links__submit">Add link</button>
    </form>
</x-layout>
