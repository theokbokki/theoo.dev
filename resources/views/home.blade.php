<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <h1 class="sro">Théoo's website</h1>
        <x-nav/>
        <main>
            <p>Hey there, welcome to my website!</p>
            <p>I’m Théo, and I run this place :))</p>
            <p>Please take a seat, a cup of good coffee and stay for as long as you’d like.</p>
            <p>I love chatting, so don’t hesitate to send me a mail at <a href="mailto:hello@theoo.dev">hello@theoo.dev</a> or DM me on <a href="https://instagram.com/theokbokki">Instagram</a>.</p>
            <p>I hope you’ll have a wonderful day!</p>
        </main>
    </body>
</html>
