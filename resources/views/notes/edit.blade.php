<x-layout baseClass="notes-form">
    <x-form-header title="New note" :href="route('notes.show', ['note' => $note])">
        <x-slot:actions>
            <x-button type="submit" formaction="{{ route('notes.update', ['note' => $note]) }}" formmethod="POST" form="note-edit-form">Edit</x-button>
        </x-slot>
    </x-form-header>
    <div class="notes-form__tools">
        <div class="notes-form__container">
            <x-button type="button" data-action="image" icon="image" modifiers="icon transparent">Upload image</x-button>
            <x-button type="button" data-action="link" icon="link" modifiers="icon transparent">Add link</x-button>
            <x-button type="button" data-action="quote" icon="quote" modifiers="icon transparent">Add quote</x-button>
            <x-button type="button" data-action="bold" icon="bold" modifiers="icon transparent">Make bold</x-button>
            <x-button type="button" data-action="italic" icon="italic" modifiers="icon transparent">Make italic</x-button>
        </div>
    </div>
    <form class="notes-form__form" id="note-edit-form">
        @csrf
        <textarea name="title" id="title" class="notes-form__title" placeholder="Note title...">{{ old('title', $note->title) }}</textarea>
        @error('title') <p class="notes-form__error">{{ $message }}</p> @enderror

        <textarea name="subtitle" id="subtitle" class="notes-form__subtitle" placeholder="Subtitle...">{{ old('subtitle', $note->subtitle) }}</textarea>

        <textarea name="content" id="content" class="notes-form__content" placeholder="Blablabla...">{{ old('content', $note->content) }}</textarea>
        @error('content') <p class="notes-form__error">{{ $message }}</p> @enderror
    </form>
</x-layout>
