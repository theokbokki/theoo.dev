<header class="form-header">
    <div class="form-header__container">
        <h1 class="form-header__title">{{ $title }}</h1>
        <x-button :$href icon="x" modifiers="icon transparent">Close form</x-button>
        <form class="form-header__actions">
            @csrf
            {{ $actions }}
        </form>
    </div>
</header>
