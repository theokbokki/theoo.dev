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
        <x-intro/>
        {{ $slot }}
    </body>
</html>
