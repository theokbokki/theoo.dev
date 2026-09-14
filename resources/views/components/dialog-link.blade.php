<{{ $tag }} {{ $contextualizedAttributes($attributes) }}>
    @isset($icon)
        <x-icon :name="$icon" />
    @endisset
    <span class="dialog-link__label">{{ $slot }}</span>
</{{ $tag }}>
