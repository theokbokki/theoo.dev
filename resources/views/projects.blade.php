<x-layout :title="__('projects.page-title')" page="projects">
    <x-slot name="metas">
        <meta name="description" content="{{ __('projects.metas.description') }}" />
        <meta property="og:url" content="{{ route('projects') }}">
        <meta property="og:title" content="{{ __('projects.title') }}">
        <meta property="og:image" content="{{ Vite::asset('resources/cards/projects.png') }}">
        <meta property="og:description" content="{{ __('projects.metas.description') }}">
        <meta name="twitter:title" content="Théoo.dev - {{ __('projects.page-title') }}">
        <meta name="twitter:description" content="{{ __('projects.metas.description') }}">
        <meta name="twitter:image:src" content="{{ Vite::asset('resources/cards/projects.png') }}">
    </x-slot>

    <h1 class="sro">@lang('projects.title')</h1>
    <x-nav />
    <x-posts
        :title="__('projects.projects')"
        :posts="$projects"
    />
</x-layout>
