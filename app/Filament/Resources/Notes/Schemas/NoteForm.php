<?php

namespace App\Filament\Resources\Notes\Schemas;

use App\Enums\NoteStatus;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Image;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class NoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required()->columnSpanFull(),

            Textarea::make('subtitle')->columnSpanFull(),

            Select::make('status')->options(NoteStatus::class)->columnSpanFull(),

            MarkdownEditor::make('content')
                ->required()
                ->columnSpanFull()
                ->fileAttachmentsDisk('public')
                ->fileAttachmentsDirectory('notes')
                ->saveUploadedFileAttachmentUsing(function (TemporaryUploadedFile $file) {
                    $directory = 'notes';
                    $name = Str::uuid()->toString();
                    $source = $file->getRealPath();

                    Image::fromPath($source)
                        ->scale(width: 1920)
                        ->toWebp()
                        ->quality(85)
                        ->storePubliclyAs($directory, "{$name}.webp", disk: 'public');

                    Image::fromPath($source)
                        ->scale(width: 640)
                        ->toWebp()
                        ->quality(85)
                        ->storePubliclyAs($directory, "{$name}_thumb.webp", disk: 'public');

                    return "{$directory}/{$name}_thumb.webp";
                }),
        ]);
    }
}
