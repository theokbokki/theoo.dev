<nav>
    <h1>{{ $page->title }}</h1>

    @foreach($crumbs as $page)
        <a href="{{ route('page', ['page' => $page]) }}">{{ $page->title }}</a>
    @endforeach
</nav>
