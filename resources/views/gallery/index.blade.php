<x-layout baseClass="gallery">
    <x-nav/>
    <h1 class="sro">Gallery</h1>
    <main class="gallery__pictures">
        @foreach($pictures as $picture)
            <img src="{{ $picture->thumbUrl }}" alt=""/>
        @endforeach
    </main>
</x-layout>
