<x-layout baseClass="posts">
    <header class="header">
        <h1 class="header__title">Feed</h1>
        <x-nav/>
    </header>
    @auth()
    <form class="actions">
        @csrf
        <a href="{{ route('posts.draft') }}" class="actions__action">New post</a>
    </form>
    @endauth
    <main class="posts__list">
        @foreach($posts as $post)
            <div class="posts__post">
                <p class="posts__date">
                    <time datetime="{{ $post->created_at }}">
                        {{ $post->created_at->year > 2025 ? $post->created_at->format('d-m-Y') : 2025 }}
                    </time>
                </p>
                <div class="posts__main">
                    <div class="posts__content">
                        {!! str()->markdown($post->content) !!}
                    </div>
                    @if($post->attachments->count())
                        <div class="posts__attachments">
                            @foreach($post->attachments as $attachment)
                                <button type="button" class="posts__zoom" command="show-modal" commandfor="attachment-{{ $attachment->id }}">
                                    <img alt="{{ $attachment->alt }}" src="/storage/posts/thumb/{{ $attachment->src }}.webp" class="posts__attachment posts__attachment--thumb"/>
                                </button>
                                <dialog id="attachment-{{ $attachment->id }}" closedby="any" class="posts__dialog">
                                    <button type="button" class="posts__close" command="close" commandfor="attachment-{{ $attachment->id }}" autofocus="" aria-label="Close">
                                        <span aria-hidden="true">✕</span>
                                    </button>
                                    <img src="/storage/posts/full/{{ $attachment->src }}.webp" alt="{{ $attachment->alt }}" class="posts__attachment--full" loading="lazy">
                                </dialog>
                            @endforeach
                        </div>
                    @endif
                </div>
                @auth()
                    <form class="posts__actions">
                        @csrf
                        <a href="{{ route('posts.edit', ['post' => $post]) }}" class="posts__action">
                            <span class="sro">Edit</span>
                            <x-icon name="edit"/>
                        </a>
                        <button type="submit" formaction="#" formmethod="POST" class="posts__action posts__action--danger">
                            <span class="sro">Delete</span>
                            <x-icon name="trash"/>
                        </button>
                    </form>
                @endauth
            </div>
        @endforeach
    </main>
</x-layout>
