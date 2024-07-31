<?php

namespace App\Entities;

use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use SplFileInfo;

class Post
{
    public function __construct(
        public string $type,
        public string $lang,
        public string $title,
        public string $slug,
        public string $excerpt,
        public DateTime $created_at,
        public ?string $link,
        public bool $published,
        public string $body,
    ){}

    public static function find(string $slug, string $type, string $lang): self
    {
        return self::createFromFile(
            new SplFileInfo(self::getFilePath($slug, $type, $lang)),
            $type,
            $lang
        );
    }

    public static function createFromFile(SplFileInfo $fileInfo, string $type, string $lang): self
    {
        $data = YamlFrontMatter::parseFile($fileInfo->getPathname());

        $post = new self(
            $type,
            $lang,
            $data->title,
            str()->slug($data->title),
            $data->excerpt,
            Carbon::parse($data->created_at),
            $data->link,
            $data->published,
            $data->body()
        );

        $post->link = $post->link ?? $post->getLink();

        return $post;
    }

    private function getLink(): string
    {
        return LaravelLocalization::localizeUrl(route($this->type, $this->slug));
    }

    public function publish(?bool $publish = true): self
    {
        $path = $this->getFilePath($this->slug, $this->type, $this->lang);
        $content = file_get_contents($path);
        $content = str_replace('published: '.!$publish, 'published: '.$publish, $content);
        file_put_contents($path, $content);

        $this->published = $publish;

        return $this;
    }

    private static function getFilePath(string $slug, string $type, string $lang): string
    {
        return storage_path("posts/{$type}s/{$lang}/{$slug}.md");
    }

    public function delete(): void
    {
        File::delete($this->getFilePath($this->slug, $this->type, $this->lang));
    }
}
