<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

#[Guarded([])]
class Link extends Model
{
    protected static function booted(): void
    {
        static::creating(function (Link $link) {
            $link->favicon ??= $link->fetchFavicon();
        });
    }

    public function fetchFavicon(): string
    {
        $host = Str::lower(parse_url($this->url, PHP_URL_HOST));
        $name = md5($this->url) . '.webp';
        $path = "links/favicons/{$name}";

        if (Storage::disk('public')->exists($path)) {
            return $path;
        }

        $response = Http::timeout(10)->get('https://www.google.com/s2/favicons', [
            'domain' => $host,
            'sz' => 128,
        ]);

        $stored = Image::fromBytes($response->body())
            ->cover(32, 32)
            ->toWebp()
            ->quality(85)
            ->storePubliclyAs('links/favicons', $name, disk: 'public');

        throw_if($stored === false, new \RuntimeException("Could not store favicon for {$host}."));

        return $path;
    }


    protected function getImage(): Attribute
    {
        if (!$this->image) {
            return Attribute::get(fn() => $this->favicon);
        }

        return Attribute::get(fn() => preg_replace('/(\.\w+)$/', '_thumb$1', $this->image));
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(LinkTag::class);
    }
}
