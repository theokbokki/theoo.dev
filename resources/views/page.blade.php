<x-base>
    <x-crumbs :$page/>
    @auth()
        <textarea name="editor" id="editor">{!! $page->content !!}</textarea>
    @else
        <div>{!! str()->markdown($page->content) !!}</div>
    @endauth
    <div>
        @foreach($page->children as $child)
            <div>
                <a href="{{ route('page', ['page' => $child]) }}">{{ $child->title }}</a>
                @auth
                    <div>
                        <button type="button">
                            <span class="sro">
                                @if($child->pinned) Pin @else Unpin @endif
                            </span>
                        </button>
                        <button type="button">
                            <span class="sro">
                                @if($child->draft) Undraft @else Draft @endif
                            </span>
                        </button>
                        <button type="button">
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
