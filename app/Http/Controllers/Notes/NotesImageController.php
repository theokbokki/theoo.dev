<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

class NotesImageController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'files' => ['required', 'array'],
            'files.*' => ['file', 'mimetypes:image/*'],
        ]);

        File::ensureDirectoryExists(Storage::disk('public')->path('notes/thumb'));
        File::ensureDirectoryExists(Storage::disk('public')->path('notes/full'));
        $manager = ImageManager::usingDriver(Driver::class);

        foreach ($request->file('files') as $index => $file) {
            $filename = $request->uuids[$index];
            $image = $manager->decode($file);

            $image->scaleDown(width: 1440, height: 1440)
                ->save(
                    Storage::disk('public')->path("notes/full/{$filename}.webp"),
                    quality: 85,
                );

            $image->scaleDown(width: 640, height: 640)
                ->save(
                    Storage::disk('public')->path("notes/thumb/{$filename}.webp"),
                    quality: 85,
                );
        }
    }
}
