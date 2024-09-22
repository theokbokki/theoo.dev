<x-layout :title="__('articles.page-title')">
    <h1 class="sro">@lang('articles.title')</h1>
    <x-nav />
    <x-posts
        :title="__('articles.articles')"
        :posts="$projects"
    />
</x-layout>
