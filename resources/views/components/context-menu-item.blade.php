<li class="context-menu__item {{ $disabled }}">
    @if($href)
        <a href="{{ $href }}">{{ $slot }}</a>
    @else
        <p>{{ $slot }}</p>
    @endif
</li>
