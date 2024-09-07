@php
    $tag = isset($href) ? 'a' : 'button';
@endphp

<{{ $tag }}
    class="button"
    @isset($href) href="{{ $href }}" @endisset
>
    {{ $content }}
</{{ $tag }}>
