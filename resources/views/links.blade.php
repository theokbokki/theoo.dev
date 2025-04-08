<x-layout>
    <section class="">
        <h2 class="sro">Links</h2>
        <ul class="list">
            @foreach($links as $link)
                <li class="list__item">
                    <x-link :$link/>
                </li>
            @endforeach
        </ul>
    <section>
</x-layout>
