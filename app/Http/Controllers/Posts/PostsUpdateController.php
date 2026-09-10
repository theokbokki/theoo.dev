<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;

class PostsUpdateController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        $post->update(['content' => $validated['content']]);

        $this->syncExistingAttachments($post, $validated['existing'] ?? []);
        $this->createAttachments(
            $post,
            $request->file('attachments') ?? [],
            $validated['alts'] ?? [],
        );

        return redirect(route('posts.index'));
    }

    protected function validator(Request $request): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            'content' => 'required',
            'existing' => ['nullable', 'array'],
            'existing.*' => ['nullable', 'string'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimetypes:image/*'],
            'alts' => ['nullable', 'array'],
            'alts.*' => ['nullable', 'string'],
        ]);
    }

    protected function syncExistingAttachments(Post $post, array $existing): void
    {
        $keptIds = array_keys($existing);

        foreach ($post->attachments as $attachment) {
            if (in_array($attachment->id, $keptIds, true)) {
                $attachment->alt = $existing[$attachment->id] ?? null;
                $attachment->save();
            } else {
                $this->deleteAttachment($attachment);
            }
        }
    }

    protected function deleteAttachment(Attachment $attachment): void
    {
        Storage::disk('public')->delete([
            "posts/full/{$attachment->src}.webp",
            "posts/thumb/{$attachment->src}.webp",
        ]);

        $attachment->delete();
    }

    protected function createAttachments(Post $post, array $attachments, array $alts): void
    {
        if (empty($attachments)) {
            return;
        }

        $this->checkForDirectories();

        $manager = ImageManager::usingDriver(Driver::class);

        foreach ($attachments as $index => $attachment) {
            $this->handleAttachment($attachment, $manager, $post, $alts[$index] ?? null);
        }
    }

    protected function checkForDirectories(): void
    {
        File::ensureDirectoryExists(Storage::disk('public')->path('posts/thumb'));
        File::ensureDirectoryExists(Storage::disk('public')->path('posts/full'));
    }

    protected function handleAttachment(
        UploadedFile $attachment,
        ImageManager $manager,
        Post $post,
        ?string $alt,
    ): void {
        $filename = str()->uuid();
        $image = $manager->decode($attachment);

        $this->createImage($image, 1440, 'full', $filename);
        $this->createImage($image, 640, 'thumb', $filename);

        $this->createAttachment($post, $filename, $alt);
    }

    protected function createImage(
        ImageInterface $image,
        int $size,
        string $dir,
        string $filename,
    ): void {
        $image
            ->scaleDown(width: $size, height: $size)
            ->save(
                Storage::disk('public')->path("posts/{$dir}/{$filename}.webp"),
                quality: 85,
            );
    }

    protected function createAttachment(Post $post, string $filename, ?string $alt): void
    {
        $attachment = new Attachment();
        $attachment->attachable()->associate($post);
        $attachment->src = $filename;
        $attachment->alt = $alt;
        $attachment->save();
    }
}
