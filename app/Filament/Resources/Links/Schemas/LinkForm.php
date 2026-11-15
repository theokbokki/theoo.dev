<?php

namespace App\Filament\Resources\Links\Schemas;

use App\Enums\LinkCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use RuntimeException;
use App\Models\LinkTag;

class LinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('url')->required()->columnSpanFull(),

            TextInput::make('description')->required()->columnSpanFull(),

            Select::make('tags')
                ->relationship('tags', 'name')
                ->multiple()
                ->searchable()
                ->preload()
                ->createOptionForm([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->unique(LinkTag::class, 'name'),
                ])
                ->required()
                ->columnSpanFull(),


            FileUpload::make('image')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->columnSpanFull()
                ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) {
                    $name = Str::uuid()->toString();
                    $source = $file->getRealPath();
                    $directory = 'links/images';

                    $full = Image::fromPath($source)
                        ->scale(width: 1280)
                        ->toWebp()
                        ->quality(85)
                        ->storePubliclyAs($directory, "{$name}.webp", disk: 'public');

                    Image::fromPath($source)
                        ->scale(width: 80)
                        ->toWebp()
                        ->quality(85)
                        ->storePubliclyAs($directory, "{$name}_thumb.webp", disk: 'public');

                    throw_if($full === false, new RuntimeException('Image failed to store.'));

                    return $full;
                }),
        ]);
    }
}
