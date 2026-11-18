<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Image;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Forms\Components\MarkdownEditor;
use RuntimeException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Enums\BookStatus;

class BooksForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required()->columnSpanFull(),

                TextInput::make('author')->required()->columnSpanFull(),

                Select::make('status')
                    ->options(BookStatus::class)
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('cover')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->columnSpanFull()
                    ->required()
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) {
                        $name = Str::uuid()->toString();
                        $source = $file->getRealPath();
                        $directory = 'books';

                        $img = Image::fromPath($source)
                            ->scale(width: 440)
                            ->toWebp()
                            ->quality(85)
                            ->storePubliclyAs($directory, "{$name}.webp", disk: 'public');

                        throw_if($img === false, new RuntimeException('Image failed to store.'));

                        return $img;
                    }),

                MarkdownEditor::make('content')
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('books')
                    ->saveUploadedFileAttachmentUsing(function (TemporaryUploadedFile $file) {
                        $directory = 'books';
                        $name = Str::uuid()->toString();
                        $source = $file->getRealPath();

                        Image::fromPath($source)
                            ->scale(width: 640)
                            ->toWebp()
                            ->quality(85)
                            ->storePubliclyAs($directory, "{$name}.webp", disk: 'public');

                        return "{$directory}/{$name}_thumb.webp";
                    }),
            ]);
    }
}
