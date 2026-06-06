<x-base>
    <x-crumbs :$page/>
    @auth()
        <div class="actions">
            <a href="{{ route('page.create', ['parentId' => $page->id]) }}" class="actions__action">New page</a>
            <button type="button" class="actions__action" data-action="editor">Toggle editor</button>
        </div>
        <textarea name="editor" id="editor" class="editor" data-route-key="{{ $page->getRouteKey() }}">{!! $page->content !!}</textarea>
    @endauth
    <div class="content">{!! str()->markdown($page->content) !!}</div>
    <div class="pages">
        @foreach($page->children as $child)
            <div class="pages__page">
                <a href="{{ route('page.show', ['page' => $child]) }}" class="pages__title">{{ $child->title }}</a>
                @auth
                    <div class="pages__buttons">
                        <button type="button" class="pages__button">
                            <x-icon icon="{{ $child->pinned ? 'unpin' : 'pin' }}"/>
                            <span class="sro">
                                @if($child->pinned) Unpin @else Pin @endif
                            </span>
                        </button>
                        <button type="button" class="pages__button">
                            <x-icon icon="{{ $child->draft ? 'undraft' : 'draft' }}"/>
                            <span class="sro">
                                @if($child->draft) Undraft @else Draft @endif
                            </span>
                        </button>
                        <button type="button" class="pages__button">
                            <x-icon icon="{{ $child->private ? 'public' : 'private' }}"/>
                            <span class="sro">
                                @if($child->private) Public @else Private @endif
                            </span>
                        </button>
                    </div>
                @endauth
            </div>
        @endforeach
    </div>
</x-base>
