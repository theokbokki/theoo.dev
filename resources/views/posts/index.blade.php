<x-layout baseClass="posts">
    <h1 class="sro">Feed</h1>
    <x-nav>
        <x-slot:actions>
            @auth()
                <x-button :href="route('posts.draft') " icon="plus" modifiers="icon secondary">New post</x-button>
            @endauth
        </x-slot>
    </x-nav>
    <main class="posts__list">
        @foreach($posts as $post)
            <div class="posts__post">
                <header class="posts__header">
                    <p class="posts__date">
                        <time datetime="{{ $post->created_at }}">
                            {{ $post->created_at->year > 2025 ? $post->created_at->humanDate() : 2025 }}
                        </time>
                    </p>
                    @auth()
                        <x-button type="button" command="show-modal" commandfor="post-{{ $post->id }}" icon="ellipsis" modifiers="icon transparent" title="Post actions"/>
                        <x-dialog id="post-{{ $post->id }}">
                            <form>
                                <x-dialog-link :href="route('posts.edit', ['post' => $post])" icon="edit">
                                    Edit post
                                </x-dialog-link>
                                <x-dialog-link type="submit" modifiers="danger" formaction="{{ route('posts.delete', ['post' => $post]) }}" formmethod="POST" icon="trash">
                                    Delete post
                                </x-dialog-link>
                            </form>
                        </x-dialog>
                    @endauth
                </header>
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
            </div>
        @endforeach
    </main>
</x-layout>
