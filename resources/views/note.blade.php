<x-layout>
    <section class="note">
        <h2>{{ $note->title }}</h2>
        {!! $note->getContent() !!}
    </section>
    <hr>
    <section>
        <h2 class="sro">{{ $sroTitle }}</h2>
        <ul class="list">
            @foreach($note->relatedNotes() as $item)
                <li class="list__item">
                    <x-link :$item/>
                </li>
            @endforeach
        </ul>
    </section>
</x-layout>
