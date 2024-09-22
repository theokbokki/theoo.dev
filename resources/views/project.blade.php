<x-layout :title="$project->title">
    <x-nav />
    <h1 class="post__title">{{ $project->title }}</h1>
    @include('posts/'.app()->getLocale().'/'.$project->slug)
</x-layout>
