<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>theoo.dev</title>

        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body class="app">
        <h1 class="sro">Theoo's personal website</h1>
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
