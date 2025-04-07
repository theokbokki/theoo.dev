<x-layout>
    <section>
        <h2 class="sro">Links</h2>
        @foreach($links as $link)
            <x-link :$link/>
        @endforeach
    <section>
</x-layout>
