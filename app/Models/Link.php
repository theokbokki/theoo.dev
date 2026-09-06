<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Http;

#[Guarded([])]
class Link extends Model
{
    public static function fetchFavicon(string $url): string
    {
        $manager = ImageManager::usingDriver(Driver::class);
        $host = parse_url($url, PHP_URL_HOST);

        $response = Http::timeout(10)->get('https://www.google.com/s2/favicons', [
            'domain' => $host,
            'sz' => 128,
        ]);

        $filename = Str::uuid();
        $path = 'links/favicons/'.$filename.'.webp';

        $manager->decode($response->body())
            ->cover(32, 32)
            ->save(
                Storage::disk('public')->path($path),
                quality: 85,
            );

        return $path;
    }
}
