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
        <x-item
            title="Bookmarks"
            href="#"
            text="The place where I store and sort the stuff I find interesting"
        />

        <x-item
            title="Bookmarks"
            href="#"
            text="The place where I store and sort the stuff I find interesting"
        />
    </x-list>

    <x-list title="{{ __('home.articles.title') }}"
        button="{{ __('home.articles.button') }}"
        href="{{ LaravelLocalization::localizeUrl(route('articles')) }}"
    >
        <x-item
            title="Bookmarks"
            href="#"
            text="The place where I store and sort the stuff I find interesting"
        />

        <x-item
            title="Bookmarks"
            href="#"
            text="The place where I store and sort the stuff I find interesting"
        />
    </x-list>
</x-page-layout>
