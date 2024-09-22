<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Théoo @isset($title) - {{ $title }} @endisset</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <noscript>
            <style>
                .app {
                    opacity: 1;
                }
            </style>
        </noscript>
    </head>
    <body class="app">
        <main>
            {{ $slot }}
        </main>
        <x-footer />
    </body>
</html>
