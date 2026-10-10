<?php

namespace App\Models;

use App\Enums\LinkCategory;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Image;
use Illuminate\Support\Str;

#[Guarded([])]
class Link extends Model
{
    protected static function booted(): void
    {
        static::creating(function (Link $link) {
            $link->favicon ??= $link->fetchFavicon();
        });
    }

    protected function casts(): array
    {
        return [
            'category' => LinkCategory::class,
        ];
    }

    public function fetchFavicon(): string
    {
        $host = parse_url($this->url, PHP_URL_HOST);

        $response = Http::timeout(10)->get('https://www.google.com/s2/favicons', [
            'domain' => $host,
            'sz' => 128,
        ]);

        $path = Image::fromBytes($response->body())
            ->cover(32, 32)
            ->toWebp()
            ->quality(85)
            ->storePubliclyAs('links/favicons', Str::uuid() . '.webp', disk: 'public');

        throw_if($path === false, new \RuntimeException("Could not store favicon for {$host}."));

        return $path;
    }
}
