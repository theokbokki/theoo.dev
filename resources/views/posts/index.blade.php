<x-layout base-class="posts">
    <h1 class="sro">Feed</h1>
    <x-nav/>
    <main class="posts__list">
        @foreach($postsByDay as $date => $posts)
            <p class="posts__date">{{ $date }}</p>
            <div class="posts__day">
                @foreach($posts as $post)
                    <div class="posts__post">
                        @if(count($post->attachments))
                            <div class="posts__attachments">
                                @foreach($post->attachments as $attachment)
                                    <button command="show-modal" commandfor="{{ $attachment->id }}" class="posts__zoom">
                                        <img src="storage/{{ $attachment->thumbPath }}" alt="{{ $attachment->alt }}" class="posts__attachment"/>
                                    </button>
                                    <dialog id="{{ $attachment->id }}" closedby="any" class="posts__dialog">
                                        <button type="button" commandfor="{{ $attachment->id }}" command="close" class="posts__close">
                                            <span class="sro">Close</span>
                                            <x-icon name="x"/>
                                        </button>
                                        <img src="storage/{{ $attachment->path }}" alt="{{ $attachment->alt }}" class="posts__full"/>
                                    </dialog>
                                @endforeach
                            </div>
                        @endif
                        <p class="posts__content">{{ $post->content}}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
    </main>
</x-layout>
