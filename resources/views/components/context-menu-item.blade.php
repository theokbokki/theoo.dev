<li class="context-menu__item {{ $disabled }}">
    @if($href)
        <a href="{{ $href }}" class="context-menu__content">{{ $slot }}</a>
    @else
        <p class="context-menu__content">{{ $slot }}</p>
    @endif
</li>
