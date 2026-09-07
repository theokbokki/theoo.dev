<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;

class PostsCreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $this->validate($request);

        $post = $this->createPost($validated['content']);

        $this->createAttachments($post, $request->file('attachments'));

        return redirect(route('posts.index'));
    }

    protected function validate(Request $request): array
    {
        return $request->validate([
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimetypes:image/*'],
            'content' => 'required',
        ]);
    }

    protected function createPost(string $content): Post
    {
        return Post::create(['content' => $content]);
    }

    protected function createAttachments(Post $post, array $attachments): void
    {
        $this->checkForDirectories();

        $manager = ImageManager::usingDriver(Driver::class);

        foreach($attachments as $attachment) {
            $this->handleAttachment($attachment, $manager, $post);
        }
    }

    protected function checkForDirectories(): void
    {
        File::ensureDirectoryExists(Storage::disk('public')->path('posts/thumb'));
        File::ensureDirectoryExists(Storage::disk('public')->path('posts/full'));
    }

    protected function handleAttachment(UploadedFile $attachment, ImageManager $manager, Post $post): void
    {
        $filename = str()->uuid();
        $image = $manager->decode($attachment);

        $this->createImage($image, 1440, 'full', $filename);
        $this->createImage($image, 640, 'thumb', $filename);

        $this->createAttachment($post, $filename);
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

    protected function createAttachment(Post $post, string $filename): void
    {
        $attachment = new Attachment();
        $attachment->attachable()->associate($post);
        $attachment->src = $filename;
        $attachment->save();
    }
}
