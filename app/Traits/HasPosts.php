<?php

namespace App\Traits;

use App\Entities\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use SplFileInfo;

trait HasPosts
{
    private function getPosts(string $type): Collection
    {
        $posts = $this->getPostsFiles($type);

        return $posts->map(fn ($post) => Post::createFromFile($post, $type, app()->getLocale()));
    }

    private function getPostsFilePath(string $type): string
    {
        $locale = app()->getLocale();

        return storage_path("posts/{$type}s/{$locale}");
    }

    /** @return Collection<int,SplFileInfo> */
    private function getPostsFiles(string $type): Collection
    {
        $filepath = $this->getPostsFilePath($type);

        return collect(File::allFiles($filepath));
    }

}
