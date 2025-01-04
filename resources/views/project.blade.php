<x-layout :title="$project->title" page="project">
    <x-slot name="metas">
        <meta name="description" content="{{ $project->excerpt }}" />
        <meta property="og:url" content="{{ route('project', $project) }}">
        <meta property="og:title" content="Théoo.dev - {{ $project->title }}">
        <meta property="og:image" content="{{ Vite::asset('resources/cards/'.$project->slug.'.png') }}">
        <meta property="og:description" content="{{ $project->excerpt }}">
        <meta name="twitter:title" content="Théoo.dev - {{ $project->title }}">
        <meta name="twitter:description" content="{{ $project->excerpt }}">
        <meta name="twitter:image:src" content="{{ Vite::asset('resources/public/cards/'.$project->slug).'.png') }}">
    </x-slot>

    <x-nav />
    <h1 class="post__title">{{ $project->title }}</h1>
    @include('posts/'.app()->getLocale().'/'.$project->slug)
</x-layout>
