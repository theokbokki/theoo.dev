<x-base>
    <x-crumbs :$page/>
    <div>{!! str()->markdown($page->content) !!}</div>
    <div>
        @foreach($page->children as $child)
            <div>
                <a href="{{ route('page', ['page' => $child]) }}">{{ $child->title }}</a>
            </div>
        @endforeach
    </div>
</x-base>
