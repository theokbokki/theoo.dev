<x-layout page="home">
    <x-slot name="metas">
        <meta name="description" content="{{ __('home.metas.description') }}" />
        <meta property="og:url" content="{{ route('home') }}">
        <meta property="og:title" content="{{ __('home.title') }}">
        <meta property="og:image" content="{{ Vite::asset('resources/cards/home.png') }}">
        <meta property="og:description" content="{{ __('home.metas.description') }}">
        <meta name="twitter:title" content="Théoo.dev">
        <meta name="twitter:description" content="{{ __('home.metas.description') }}">
        <meta name="twitter:image:src" content="{{ Vite::asset('resources/cards/home.png') }}">
    </x-slot>

    <h1 class="sro">@lang('home.title')</h1>
    <x-nav />
    <x-intro />
    @if(isset($projects) && $projects->count())
        <x-posts
            :title="__('home.projects')"
            :button="__('home.projects-button')"
            :posts="$projects"
        />
    @endif
    @if(isset($articles) && $articles->count())
        <x-posts
            :title="__('home.articles')"
            :button="__('home.articles-button')"
            :posts="$articles"
        />
    @endif
</x-layout>
