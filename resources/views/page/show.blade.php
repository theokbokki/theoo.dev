<x-base :title="$page->title">
    <x-crumbs :$page/>
    @auth()
        <div class="actions">
            <a href="{{ route('page.create', ['parentId' => $page->id]) }}" class="actions__action">New page</a>
            <a href="{{ route('page.edit', ['id' => $page->id]) }}" class="actions__action">Edit page</a>
            <button type="button" class="actions__action" data-action="editor">Toggle editor</button>
            <div>
                <button type="button" class="actions__action" data-action="image">Add image</button>
                <input type="file" id="image" accept="image/*" hidden multiple/>
            </div>
        </div>
        <textarea name="editor" id="editor" class="editor" data-id="{{ $page->id }}">{!! $page->content !!}</textarea>
    @endauth
    <x-content :content="$page->content"/>
    <div class="pages">
        @foreach($children as $child)
            <div class="pages__page" @if($child->draft) data-draft @endif>
                <a href="{{ route('page.show', ['page' => $child]) }}" class="pages__title">{{ $child->title }}</a>
            </div>
        @endforeach
    </div>
</x-base>
