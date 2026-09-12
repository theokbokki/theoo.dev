<{{ $tag }} {{ $contextualizedAttributes($attributes) }}>
    @isset($icon)
        <x-icon :name="$icon" />
    @endisset
    <span class="button__label">{{ $slot }}</span>
</{{ $tag }}>
