<li class="menu__item" style="--icon-color: {{ $color }}">
    <a href="{{ $href }}" class="menu__link">
        <x-icon name="{{ $icon }}"/>
        <span>{{ $slot }}</span>
    </a>
</li>
