<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body id="app" {{ $attributes->merge(['class' => 'md:flex md:h-screen']) }}>
        <script>document.body.classList.add('opacity-0')</script>
        <x-nav/>
    </body>
</html>
