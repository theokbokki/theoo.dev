<x-layout baseClass="gallery">
    <x-nav/>
    <h1 class="sro">Gallery</h1>
    <main class="gallery__pictures">
        @foreach($pictures as $picture)
            <figure class="gallery__picture">
                <img src="{{ $picture->thumbUrl }}" alt="" class="gallery__img" />
            </figure>
        @endforeach
    </main>
</x-layout>
