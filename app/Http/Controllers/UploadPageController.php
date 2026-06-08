<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

class UploadPageController extends Controller
{
    public function __invoke(Request $request, int $id)
    {
        $request->validate([
            'files' => ['required', 'array'],
            'files.*' => ['file', 'mimetypes:image/*'],
        ]);

        File::ensureDirectoryExists(Storage::disk('public')->path('images'));
        $manager = ImageManager::usingDriver(Driver::class);
        $results = [];

        foreach ($request->file('files') as $file) {
            $filename = Str::uuid();
            $image = $manager->decode($file);

            $image->save(Storage::disk('public')->path("images/{$filename}.webp"));

            $image->scaleDown(width: 640, height: 640)
                ->save(
                    Storage::disk('public')->path("images/{$filename}-thumb.webp"),
                    quality: 85,
                );

            $results[] = [
                'full' => Storage::url("images/{$filename}.webp"),
                'thumb' => Storage::url("images/{$filename}-thumb.webp"),
            ];
        }

        return response()->json($results);
    }
}
