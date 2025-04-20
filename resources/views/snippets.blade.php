<x-layout title="Snippets">
    <x-slot name="metas">
        <meta name="description" content="The snippets page of Théoo's personal website. This is the page where I share all the code snippets I created or found useful" />
    </x-slot>

    <section>
        <h2 class="sro">A list of all my snippets</h2>
        <ul class="list">
            @foreach($snippets as $item)
                <li class="list__item">
                    <x-link :$item/>
                </li>
            @endforeach
        </ul>
    <section>
</x-layout>
