<x-layout>
    <h1 class="sro">@lang('home.title')</h1>
    <x-nav />
    <x-intro />
    @if(isset($projects) && $projects->count())
        <x-posts
            :title="__('home.projects')"
            :button="__('home.projects-button')"
            :posts="$projects"
            type="projects"
        />
    @endif
    @if(isset($articles) && $articles->count())
        <x-posts
            :title="__('home.articles')"
            :button="__('home.articles-button')"
            :posts="$articles"
            type="articles"
        />
    @endif
</x-layout>
