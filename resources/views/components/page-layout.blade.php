<x-base-layout>
    <h1 class="sro">{{ $title }}</h1>

    <header class="app_header">
        {{ $nav }}
    </header>

    <main class="app__content">
        {{ $slot }}
    </main>

    <x-footer />
</x-base-layout>
