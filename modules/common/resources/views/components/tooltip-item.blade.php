@if(request()->routeIs($route))
    <p class="tooltip__item tooltip__item--active">
        <x-common::icon :name="$icon"/>
        <span>{{ $text }}</span>
    </p>
@else
    <a class="tooltip__item" href="{{ route($route) }}" data-focus-ring>
        <x-common::icon :name="$icon"/>
        <span>{{ $text }}</span>
    </a>
@endif
