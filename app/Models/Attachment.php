<?php

namespace App\Models;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use RuntimeException;

#[Guarded([])]
class Attachment extends Model
{
    protected static function booted(): void
    {
        static::deleting(function (Attachment $attachment) {
            Storage::disk('public')->delete([$attachment->path, $attachment->thumb_path]);
        });
    }

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }

    protected function thumbPath(): Attribute
    {
        return Attribute::get(fn() => preg_replace('/(\.\w+)$/', '_thumb$1', $this->path));
    }

    public static function repeater(): Repeater
    {
        $directory = Str::plural(Str::snake(class_basename(Post::class))) . '/attachments';

        return Repeater::make('attachments')
            ->relationship()
            ->orderColumn('sort')
            ->columnSpanFull()
            ->schema([
                FileUpload::make('path')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->required()
                    ->columnSpanFull()
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) use ($directory) {
                        $name = Str::uuid()->toString();
                        $source = $file->getRealPath();

                        $full = Image::fromPath($source)
                            ->scale(width: 1920)
                            ->toWebp()
                            ->quality(85)
                            ->storePubliclyAs($directory, "{$name}.webp", disk: 'public');

                        Image::fromPath($source)
                            ->scale(width: 640)
                            ->toWebp()
                            ->quality(85)
                            ->storePubliclyAs($directory, "{$name}_thumb.webp", disk: 'public');

                        throw_if($full === false, new RuntimeException('Image failed to store.'));

                        return $full;
                    }),

                TextInput::make('alt')->label('Alt text')->maxLength(255)->columnSpanFull(),
            ]);
    }
}
