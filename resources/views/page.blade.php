<x-base>
    <x-crumbs :$page/>
    @auth()
        <textarea name="editor" id="editor" class="editor">{!! $page->content !!}</textarea>
    @else
        <div>{!! str()->markdown($page->content) !!}</div>
    @endauth
    <div class="pages">
        @foreach($page->children as $child)
            <div class="pages__page">
                <a href="{{ route('page', ['page' => $child]) }}" class="pages__title">{{ $child->title }}</a>
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
