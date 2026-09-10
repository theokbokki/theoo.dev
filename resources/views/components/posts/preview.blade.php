<div class="posts__preview">
    <div class="posts__picture">
        <button type="button" class="posts__zoom posts__zoom--preview" command="show-modal" commandfor="preview-{{ $id }}">
            <img alt="{{ $alt }}" src="{{ $file }}" class="posts__preview posts__preview--thumb"/>
        </button>
        <button type="button" class="posts__remove" data-action="delete-preview-{{ $id }}" aria-label="Delete preview">
            <span aria-hidden="true">✕</span>
        </button>
    </div>
    <dialog id="preview-{{ $id }}" closedby="any" class="posts__dialog">
        <button type="button" class="posts__close" command="close" commandfor="preview-{{ $id }}" autofocus="" aria-label="Close">
            <span aria-hidden="true">✕</span>
        </button>
        <div class="posts__form posts__form--preview">
            <img src="{{ $file }}" alt="{{ $alt }}" class="posts__preview posts__preview--full" loading="lazy">
            <textarea name="preview-{{ $id }}-alt" id="preview-{{ $id }}-alt"  placeholder="Alt here..." class="posts__textarea">{{ old('alt', $alt) }}</textarea/>
        </div>
    </dialog>
</div>
