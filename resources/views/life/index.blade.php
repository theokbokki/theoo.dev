<x-layout base-class="life">
    <h1 class="sro">Life</h1>
    <form method="POST" action="{{ route('life.update', ['life' => $life]) }}" class="life__form">
        @csrf
        <textarea class="life__content" name="content" id="content" autofocus>{{ $life->content }}</textarea>
    </form>
</x-layout>
