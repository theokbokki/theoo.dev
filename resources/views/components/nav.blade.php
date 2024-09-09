<nav class="nav">
    <div class="nav__logo">
        <a href="{{ LaravelLocalization::localizeUrl(route('home')) }}">
            @icon('logo')
        </a>
    </div>
    <div class="nav__contact">
        <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}" class="nav__link">@lang('nav.contact')</a>
    </div>
</nav>
