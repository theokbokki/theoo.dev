<x-layout>
    <header>
        <h1>{{ $note->title }}</h1>
        <x-nav/>
    </header>
    <main>
        {!! $note->content !!}
    </main>
</x-layout>
