<x-layout>
    <x-slot name="title">@lang('projects.page-title')</x-slot>
    <h1 class="sro">@lang('projects.title')</h1>
    <x-nav />
    <x-posts
        :title="__('projects.projects')"
        :posts="$projects"
    />
</x-layout>
