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
        <header class="app__header">
            <x-nav title="Main navigation">
                <x-nav-item href="#">Links</x-nav-item>
                <x-nav-item href="#">Notes</x-nav-item>
                <x-nav-item :href="route('home')">Shaders</x-nav-item>
                <x-nav-item href="#">Snippets</x-nav-item>
            </x-nav>
            <x-context-menu title="Socials links navigation">
                <x-context-menu-item disabled>Socials</x-context-menu-item>
                <x-context-menu-separator/>
                <x-context-menu-item href="mailto:hello@theoo.dev">Email</x-context-menu-item>
                <x-context-menu-item href="https://github.com/theokbokki">Github</x-context-menu-item>
                <x-context-menu-item href="https://bsky.app/profile/theokbokki.bsky.social">Bluesky</x-context-menu-item>
                <x-context-menu-item href="https://x.com/theokbokki_">Twitter/X</x-context-menu-item>
                <x-context-menu-item href="https://instagram.com/theokbokki">Instagram</x-context-menu-item>
            </x-context-menu>
            <x-intro/>
        </header>
        <main>
            {{ $slot }}
        </main>
    </body>
</html>
