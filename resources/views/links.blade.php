<x-layout>
    <section class="">
        <h2 class="sro">Links</h2>
        <ul class="list">
            @foreach($links as $item)
                <li class="list__item">
                    <x-link :$item/>
                </li>
            @endforeach
        </ul>
    <section>
</x-layout>
