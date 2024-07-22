<footer class="footer">
    <div class="footer__weather">
        <p class="footer__text">
            <span>@icon('cloud')</span>
            <span>Cloudy in Liège</span>
        </p>
    </div>
    <div class="footer__time">
        @icon('clock')
    </div>
</footer>

@pushOnce('styles')
<style>
    .footer {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        color: rgba(var(--grey), .5);
    }

    .footer__text {
        display: flex;
        align-content: center;
        gap: .5rem;
        font-family: var(--pixel);
        text-transform: uppercase;
    }
</style>
@endPushOnce
