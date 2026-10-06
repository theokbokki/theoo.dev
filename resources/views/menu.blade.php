<x-layout base-class="menu">
    <header class="menu__header">
        <h1 class="menu__title">Menu</h1>
        <a href="{{ route('home') }}" onclick="document.referrer ? history.back() : window.location.href = '/'; return false;" class="menu__close">
            <span class="sro">Close menu</span>
            <x-icon name="x"/>
        </a>
    </header>
    <nav class="menu__nav">
        <h2 class="menu__subtitle">Pages</h2>
        <ul class="menu__list">
            <x-menu-item icon="house" :href="route('home')" color="#FFBB00">Home</x-menu-item>
            <x-menu-item icon="pencil-and-scribble" :href="route('notes.index')" color="#FF0000">Notes</x-menu-item>
            <x-menu-item icon="rectangle-stack" :href="route('posts.index')" color="#FF00DD">Feed</x-menu-item>
            <x-menu-item icon="bookmark" :href="route('home')" color="#001EFF">Links</x-menu-item>
            <x-menu-item icon="paintbrush" :href="route('home')" color="#21B200">Designs</x-menu-item>
        </ul>
    </nav>
    <nav class="menu__nav">
        <h2 class="menu__subtitle">Contact</h2>
        <ul class="menu__list">
            <x-menu-item icon="envelope" href="mailto:hello@theoo.dev" color="#00A4E5">Mail</x-menu-item>
            <x-menu-item icon="instagram" href="https://instagram.com/theokbokki">Instagram</x-menu-item>
            <x-menu-item icon="github" href="https://github.com/theokbokki">GitHub</x-menu-item>
        </ul>
    </nav>
</x-layout>
