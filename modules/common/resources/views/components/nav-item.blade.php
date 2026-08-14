@if(request()->routeIs($route))
    <p class="nav__item nav__item--active">{{ $text }}</p>
@else
    <a class="nav__item" href="{{ route($route) }}">{{ $text }}</a>
@endif
