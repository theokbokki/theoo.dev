<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/favicons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::asset('resources/favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/favicons/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ Vite::asset('resources/favicons/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ Vite::asset('resources/favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#00a300">
        <meta name="theme-color" content="#ffffff">
        <meta name="keywords" content="Web, Design, Laravel, PHP, Developer, Digital Garden, Shaders" />

        @isset($metas) {{ $metas }} @endisset

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
            <x-nav-item :href="route('trinkets')">Trinkets</x-nav-item>
        </x-nav>
        <main class="app__main">
            {{ $slot }}
        </main>
    </body>
</html>
