<a href="{{ $href }}"
    class="flex items-center gap-8 p-8 mt-8 transition-all duration-200 {{ $isActive() ? 'bg-neutral-100' : '' }} hover:bg-neutral-200/50 rounded-md focus-visible:bg-neutral-200/50 active:bg-neutral-100"
>
    <span class="text-neutral-500">@svg($icon)</span>
    <span>{{ $content }}</span>
</a>
