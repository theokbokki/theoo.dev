<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/favicons/'.$cat.'/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ Vite::asset('resources/favicons/'.$cat.'/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ Vite::asset('resources/favicons/'.$cat.'/web-app-manifest-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="512x512" href="{{ Vite::asset('resources/favicons/'.$cat.'/web-app-manifest-512x512.png') }}">
        <link rel="manifest" href="{{ Vite::asset('resources/favicons/'.$cat.'/site.webmanifest') }}">
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
    <body class="app" style="--bg: {{ $bg }}; --fg: {{ $fg }};">
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
