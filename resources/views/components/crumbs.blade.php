<nav class="crumbs">
    <h1 class="crumbs__crumb">{{ $page->title }}</h1>

    @foreach($crumbs as $page)
        <a href="{{ route('page.show', ['page' => $page]) }}" class="crumbs__crumb">
            <span class="crumbs__text">{{ $page->title }}</span>
        </a>
    @endforeach
</nav>
