<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class UploadPageController extends Controller
{
    public function __invoke(Request $request, int $id)
    {
        $request->validate([
            'file' => ['required', 'image', 'max:10240'],
        ]);

        $filename = Str::uuid();
        File::ensureDirectoryExists(Storage::disk('public')->path('images'));

        $manager = ImageManager::usingDriver(Driver::class);
        $image = $manager->decode($request->file('file'));

        $image->save(Storage::disk('public')->path("images/{$filename}.webp"));

        $image->scaleDown(width: 640, height: 640)
            ->save(
                Storage::disk('public')->path("images/{$filename}-thumb.webp"),
                quality: 85,
            );

        return response()->json([
            'full' => Storage::url("images/{$filename}.webp"),
            'thumb' => Storage::url("images/{$filename}-thumb.webp"),
        ]);
    }
}
