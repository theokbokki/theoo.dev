<?php

namespace App\View\Components;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class Content extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $content = '',
    ) {}

    public function format(): string
    {
        return str()->markdown($this->content) |> $this->favicons(...);
    }

    protected function favicons(string $html): string
    {
        $doc = new \DOMDocument;
        @$doc->loadHTML(
            '<meta charset="utf-8">'.$html,
        );

        $links = iterator_to_array($doc->getElementsByTagName('a'));

        foreach ($links as $link) {
            $href = $link->getAttribute('href');

            if (! $href || preg_match('/^(mailto:|tel:|#|javascript:)/', $href)) {
                continue;
            }

            $host = parse_url($href, PHP_URL_HOST);

            if (! $host) {
                continue;
            }

            $src = $this->getFavicon($host);

            if (! $src) {
                continue;
            }

            $iconSpan = $doc->createElement('span');
            $img = $doc->createElement('img');
            $img->setAttribute('class', 'favicon');
            $img->setAttribute('src', $src);
            $img->setAttribute('alt', '');
            $iconSpan->appendChild($img);

            $textSpan = $doc->createElement('span');
            while ($link->firstChild) {
                $textSpan->appendChild($link->firstChild);
            }

            $link->appendChild($iconSpan);
            $link->appendChild($textSpan);
        }

        $output = $doc->saveHTML();
        $output = str_replace('<meta charset="utf-8">', '', $output);

        return trim($output);
    }

    protected function getFavicon(string $host): string
    {
        $filename = md5($host).'.png';
        $path = "favicons/{$filename}";

        if (! Storage::disk('public')->exists($path)) {
            dispatch(fn () => $this->fetchAndStoreFavicon($host, $path))->afterResponse();

            return '';
        }

        $age = now()->diffInDays(\Illuminate\Support\Carbon::createFromTimestamp(
            Storage::disk('public')->lastModified($path),
        ));

        $maxAge = 14 + (crc32($host) % 7);

        if ($age > $maxAge) {
            dispatch(fn () => $this->fetchAndStoreFavicon($host, $path));
        }

        return Storage::url($path);
    }

    protected function fetchAndStoreFavicon(string $host, string $path): void
    {
        try {
            $icon = Http::timeout(5)
                ->get("https://www.google.com/s2/favicons?domain={$host}&sz=32")
                ->body();

            Storage::disk('public')->put($path, $icon);
        } catch (\Throwable) {
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content');
    }
}
