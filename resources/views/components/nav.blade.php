<nav class="nav">
    <h2 class="sro">Main navigation</h2>
    <div class="nav__container">
        <a href="{{ route('home') }}" class="nav__link">
            <span class="sro">Home</span>
            <img src="{{ Vite::asset('resources/images/avatar.webp') }}" alt="A picture of me with Matcha on my head" class="nav__avatar"/>
        </a>
        <div class="nav__actions">
            <x-button type="button" command="show-modal" commandfor="menu" modifiers="secondary">
                Menu
            </x-button>
            {{ $actions ?? '' }}
        </div>
    </div>
    <x-dialog id="menu">
        <x-dialog-link :href="route('notes.index')" icon="edit">Notes</x-dialog-link>
        <x-dialog-link :href="route('posts.index')" icon="feed">Feed</x-dialog-link>
        <x-dialog-link :href="route('links.index')" icon="link">Links</x-dialog-link>
    </x-dialog>
</nav>
