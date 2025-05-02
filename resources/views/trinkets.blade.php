<x-layout title="Trinkets">
    <x-slot name="metas">
        <meta name="description" content="The trinkets page of Théoo's personal website. This is the page where I share all the images I like or created." />
    </x-slot>

    <section>
        <h2 class="sro">A list of all my trinkets</h2>
        @foreach($groups as $key => $group)
            <x-trinkets-group :$group :$key/>
        @endforeach
    <section>
</x-layout>
