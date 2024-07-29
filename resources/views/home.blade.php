<x-page-layout>
    <x-slot name="title">
        @lang('home.title')
    </x-slot>

    <x-slot name="nav">
        <x-home-nav />
    </x-slot>

    <x-intro />

    <x-player/>

    <x-list title="{{ __('home.projects.title') }}"
        button="{{ __('home.projects.button') }}"
        href="{{ LaravelLocalization::localizeUrl(route('projects')) }}"
    >
        @foreach ($projects as $project)
            <x-item
                title="{{ $project->title }}"
                href="{{ $project->link }}"
                text="{{ $project->excerpt }}"
            />
        @endforeach
    </x-list>

    <x-list title="{{ __('home.articles.title') }}"
        button="{{ __('home.articles.button') }}"
        href="{{ LaravelLocalization::localizeUrl(route('articles')) }}"
    >
        @foreach ($articles as $article)
            <x-item
                title="{{ $article->title }}"
                href="{{ $article->link }}"
                text="{{ $article->excerpt }}"
            />
        @endforeach
    </x-list>
</x-page-layout>
