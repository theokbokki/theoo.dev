<x-layout base-class="books">
    <header class="books__header">
        <x-nav/>
        <h1 class="books__title">Books</h1>
        <p class="books__intro">My personal library on the internet.</p>
        <p class="books__intro">Here you’ll find notes about books I’ve read as well as a list of books waiting to be read and a list of books I want to buy.</p>
    </header>
    <main class="books__main">
        <ul class="books__list">
            @foreach($books as $book)
                <li class="books__item">
                    <a href="#" class="books__link">{{ $book->title.' by '.$book->author }}</a>
                    <img src="/storage/{{ $book->cover }}" alt="" class="books__cover" />
                    <p class="book__status">{{ $book->status->getLabel() }}</p>
                </li>
            @endforeach
        </ul>
    </main>
</x-layout>
