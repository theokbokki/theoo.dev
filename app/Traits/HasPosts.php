<?php

namespace App\Traits;

use App\Entities\Post;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\YamlFrontMatter\Document;
use SplFileInfo;
use Spatie\YamlFrontMatter\YamlFrontMatter;

trait HasPosts
{
    private function getPosts(string $type): Collection
    {
        $posts = $this->getPostsFiles($type);

        return $posts->map(fn ($post) => $this->addDataToPosts($post, $type));
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

    private function addDataToPosts(SplFileInfo $post, string $type): Post
    {
        $data = YamlFrontMatter::parseFile($post->getPathname());
        return new Post(
            $data->title,
            $data->excerpt,
            Carbon::parse($data->created_at),
            $data->link ?? $this->getPostLink($data, $type),
            $data->body()
        );
    }

    private function getPostLink(Document $data, string $type): string
    {
        $slug = str()->slug($data->title);

        return LaravelLocalization::localizeUrl(route($type, ['slug' => $slug]));
    }
}
