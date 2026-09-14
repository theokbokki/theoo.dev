<x-layout baseClass="notes notes--show">
    <h1 class="notes__title">{{ $note->title }}</h1>
    <a href="{{ route('notes.index') }}" class="notes__back">← Back to index</a>
    <x-nav>
        @auth()
            <x-slot:actions>
                <x-button type="button" command="show-modal" commandfor="actions" icon="ellipsis" modifiers="icon secondary"/>
                <x-dialog id="actions">
                    <form>
                        <x-dialog-link
                            type="submit"
                            formaction="{{ route('notes.status', ['note' => $note]) }}"
                            formmethod="POST"
                            icon="{{ $note->status->value === 'draft' ? 'eye-crossed' : 'eye' }}"
                        >
                            {{ $note->status->label() }}
                        </x-dialog-link>
                        <x-dialog-link :href="route('notes.edit', ['note' => $note])" icon="edit">
                            Edit Note
                        </x-dialog-link>
                        <x-dialog-link type="submit" modifiers="danger" formaction="{{ route('notes.delete', ['note' => $note]) }}" formmethod="POST" icon="trash">
                            Delete Note
                        </x-dialog-link>
                    </form>
                </x-dialog>
            </x-slot>
        @endauth
    </x-nav>
    <p class="notes__subtitle">{{ $note->subtitle }}</p>
    <main class="notes__content">
        {!! $note->content !!}
    </main>
</x-layout>
