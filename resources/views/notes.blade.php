<x-layout :showIntro="true">
    <section>
        <h2 class="sro">A list of all things I wrote</h2>
        <ul class="list">
            @foreach($notes as $item)
                <li class="list__item">
                    <x-link :$item/>
                </li>
            @endforeach
        </ul>
    <section>
</x-layout>
