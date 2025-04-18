<x-layout title="Snippets">
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
