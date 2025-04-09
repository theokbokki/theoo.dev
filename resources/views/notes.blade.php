<x-layout>
    <section>
        <h2 class="sro">Links</h2>
        <ul class="list">
            @foreach($notes as $item)
                <li class="list__item">
                    <x-link :$item/>
                </li>
            @endforeach
        </ul>
    <section>
</x-layout>
