<x-layout>
    <x-nav />
    <h1 class="post__title">{{ $article->title }}</h1>
    @include('posts/'.app()->getLocale().'/'.$article->slug)
</x-layout>
