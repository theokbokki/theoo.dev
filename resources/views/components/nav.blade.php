<nav class="nav">
    <div class="nav__left">{{ $left }}</div>
    @isset($center)
        <div class="nav__center">{{ $center }}</div>
    @endisset
    <div class="nav__right">{{ $right }}</div>
</nav>

@pushOnce('styles')
<style>
    .nav {
        display: flex;
        align-items: center;
    }

    .nav__left {
        flex: 1;
    }

    .nav__center {
        width: max-content;
    }

    .nav__right {
        flex: 1;
        text-align: right;
    }
</style>
@endPushOnce
