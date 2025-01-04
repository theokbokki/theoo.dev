@php
    $tag = isset($href) ? 'a' : 'button';
@endphp

<{{ $tag }}
    class="button"
    {{ $attributes }}
>
    {{ $content }}
</{{ $tag }}>
