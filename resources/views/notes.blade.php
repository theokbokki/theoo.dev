<x-layout title="Notes">
    <x-slot name="metas">
        <meta name="description" content="The notes page of Théoo's personal website. This is the page where I share all the notes, recipes, thoughts etc that I write" />
    </x-slot>

    <section>
        <h2 class="sro">A list of all my notes</h2>
        <ul class="list">
            @foreach($notes as $item)
                <li class="list__item">
                    <x-link :$item/>
                </li>
            @endforeach
        </ul>
    <section>
</x-layout>
