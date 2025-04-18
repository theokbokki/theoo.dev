<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

        @vite('resources/css/app.scss')

        @if($needsJs)
            @vite('resources/js/app.js')
        @endif
    </head>
    <body class="app">
        <h1 class="sro">{{ $title }}</h1>
        <x-nav title="Main navigation">
            <x-nav-item :href="route('home')">Home</x-nav-item>
            <x-nav-item :href="route('links')">Links</x-nav-item>
            <x-nav-item :href="route('notes')">Notes</x-nav-item>
            <x-nav-item :href="route('shaders')">Shaders</x-nav-item>
            <x-nav-item :href="route('snippets')">Snippets</x-nav-item>
        </x-nav>
        <main class="app__main">
            {{ $slot }}
        </main>
    </body>
</html>
