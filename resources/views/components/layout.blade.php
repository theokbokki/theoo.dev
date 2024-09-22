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

        <title>Théoo @isset($title) - {{ $title }} @endisset</title>

        <meta name="description" content="Théo Léonet's portfolio. I share projects I made and articles I wrote." />
        <meta name="keywords" content="Web, Design, Laravel, PHP, Developer, Neovim" />
        <meta property="og:type" content="website">
        <meta property="og:url" content="/">
        <meta property="og:title" content="Théoo's portfolio">
        <meta property="og:image" content="">
        <meta property="og:site_name" content="Théoo">
        <meta property="og:description" content="">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@theokbokki_">
        <meta name="twitter:creator" content="@theokbokki_">
        <meta name="twitter:title" content="">
        <meta name="twitter:description" content="">
        <meta name="twitter:image:src" content="">

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
        {{ $slot }}
        <x-footer />
    </body>
</html>
