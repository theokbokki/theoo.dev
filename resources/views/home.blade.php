<x-layout title="Home">
    <x-slot name="metas">
        <meta name="description" content="The homepage of Théoo's personal website. I use it as a place to talk about the website, how and why it was made." />
    </x-slot>

    <section class="note">
        {!! $content !!}
    </section>
</x-layout>
