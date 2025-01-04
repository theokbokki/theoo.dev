<x-layout :title="__('articles.page-title')" page="articles">
    <x-slot name="metas">
        <meta name="description" content="{{ __('articles.metas.description') }}" />
        <meta property="og:url" content="{{ route('articles') }}">
        <meta property="og:title" content="{{ __('articles.title') }}">
        <meta property="og:image" content="{{ Vite::asset('resources/cards/articles.png') }}">
        <meta property="og:description" content="{{ __('articles.metas.description') }}">
        <meta name="twitter:title" content="Théoo.dev - {{ __('articles.page-title') }}">
        <meta name="twitter:description" content="{{ __('articles.metas.description') }}">
        <meta name="twitter:image:src" content="{{ Vite::asset('resources/cards/articles.png') }}">
    </x-slot>

    <h1 class="sro">@lang('articles.title')</h1>
    <x-nav />
    <x-posts
        :title="__('articles.articles')"
        :posts="$articles"
    />
</x-layout>
