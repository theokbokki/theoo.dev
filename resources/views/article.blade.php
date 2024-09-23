<x-layout :title="$article->title">
    <x-slot name="metas">
        <meta name="description" content="{{ $article->excerpt }}" />
        <meta property="og:url" content="{{ route('article', $article) }}">
        <meta property="og:title" content="Théoo.dev - {{ $article->title }}">
        <meta property="og:image" content="{{ Vite::asset('resources/cards/'.$article->slug.'.png') }}">
        <meta property="og:description" content="{{ $article->excerpt }}">
        <meta name="twitter:title" content="Théoo.dev - {{ $article->title }}">
        <meta name="twitter:description" content="{{ $article->excerpt }}">
        <meta name="twitter:image:src" content="{{ Vite::asset('resources/cards/'.$article->slug.'.png') }}">
    </x-slot>

    <x-nav />
    <h1 class="post__title">{{ $article->title }}</h1>
    @include('posts/'.app()->getLocale().'/'.$article->slug)
</x-layout>
