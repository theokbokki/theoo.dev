<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Format;
use App\View\Components\Posts\Preview;

class AttachmentsUploadController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'files' => ['required', 'array'],
            'files.*' => ['file', 'mimetypes:image/*'],
        ]);

        $manager = ImageManager::usingDriver(Driver::class);
        $previews = [];

        foreach($request->file('files') as $file) {
            $id = str()->uuid();
            $image = $manager
                ->decode($file)
                ->scaleDown(width: 640, height: 640);

            $thumbnail = $image->encodeUsingFormat(Format::WEBP)->toDataUri();

            $previews[] = Blade::renderComponent(new Preview($thumbnail, $id));
        }

        return response()->json(['html' => $previews]);
    }
}
