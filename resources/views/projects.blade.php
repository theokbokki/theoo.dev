<x-layout :title="__('projects.page-title')">
    <h1 class="sro">@lang('projects.title')</h1>
    <x-nav />
    <x-posts
        :title="__('projects.projects')"
        :posts="$projects"
    />
</x-layout>
