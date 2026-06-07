<x-base>
    <x-crumbs :$page/>
    @auth()
        <div class="actions">
            <a href="{{ route('page.create', ['parentId' => $page->id]) }}" class="actions__action">New page</a>
            <a href="{{ route('page.edit', ['id' => $page->id]) }}" class="actions__action">Edit page</a>
            <button type="button" class="actions__action" data-action="editor">Toggle editor</button>
        </div>
        <textarea name="editor" id="editor" class="editor" data-id="{{ $page->id }}">{!! $page->content !!}</textarea>
    @endauth
    <div class="content">{!! str()->markdown($page->content) !!}</div>
    <div class="pages">
        @foreach($page->children as $child)
            <div class="pages__page">
                <a href="{{ route('page.show', ['page' => $child]) }}" class="pages__title">{{ $child->title }}</a>
            </div>
        @endforeach
    </div>
</x-base>
