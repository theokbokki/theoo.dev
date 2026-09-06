<x-layout baseClass="links">
    <header class="header">
        <h1 class="header__title">Links</h1>
        <x-nav/>
    </header>
    @auth()
    <form class="actions">
        @csrf
        <a href="{{ route('links.draft') }}" class="actions__action">Add link</a>
    </form>
    @endauth
    <main class="links__table">
        @foreach($links as $link)
            <div class="links__link">
                <img alt="" src="/storage/{{ $link->favicon }}" class="links__favicon"/>
                <a href="{{ $link->url }}" class="links__url" target="_blank">{!! preg_replace('~([/.?#&=_-])~', '$1<wbr>', $link->url) !!}</a>
                <p class="links__description">{{ $link->description }}</p>
                @auth()
                <form class="links__actions">
                    @csrf
                    <a href="{{ route('links.edit', ['link' => $link]) }}" class="links__action">
                        <span class="sro">Edit</span>
                        <x-icon name="edit"/>
                    </a>
                    <button type="submit" formaction="{{ route('links.delete', ['link' => $link]) }}" formmethod="POST" class="links__action links__action--danger">
                        <span class="sro">Delete</span>
                        <x-icon name="trash"/>
                    </button>
                </form>
                @endauth
            </div>
        @endforeach
    </main>
</x-layout>
