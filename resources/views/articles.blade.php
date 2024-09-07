<x-layout>
    <x-slot name="title">@lang('articles.page-title')</x-slot>
    <h1 class="sro">@lang('articles.title')</h1>
    <x-nav />
    <x-posts
        :title="__('articles.articles')"
        :posts="$projects"
    />
</x-layout>
