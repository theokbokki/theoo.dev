<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/favicons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::asset('resources/favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/favicons/favicon-16x16.png') }}">
        <link rel="manifest" href="/site.webmanifest">

        @fonts
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body class="{{ $baseClass }}">
        {{ $slot }}
    </body>
</html>
