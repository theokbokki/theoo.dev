<?php

namespace App\Filament\Resources\Pictures\Pages;

use App\Filament\Resources\Pictures\PictureResource;
use Filament\Resources\Pages\ListRecords;
use App\Models\Picture;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Image;
use RuntimeException;

class ListPictures extends ListRecords
{
    protected static string $resource = PictureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('upload')
                ->label('Upload pictures')
                ->icon('heroicon-o-arrow-up-tray')
                ->schema([
                    FileUpload::make('images')
                        ->multiple()
                        ->image()
                        ->imageEditor()
                        ->panelLayout('grid')
                        ->required()
                        ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) {
                            $name = Str::uuid()->toString();
                            $source = $file->getRealPath();

                            $full = Image::fromPath($source)
                                ->scale(width: 1280)
                                ->toWebp()
                                ->quality(85)
                                ->storePubliclyAs('gallery', "{$name}.webp", disk: 'public');

                            $thumb = Image::fromPath($source)
                                ->scale(width: 480)
                                ->toWebp()
                                ->quality(85)
                                ->storePubliclyAs('gallery/thumbs', "{$name}.webp", disk: 'public');

                            throw_if($full === false || $thumb === false, new RuntimeException('Image failed to store.'));

                            return $full;
                        }),
                ])
                ->action(function (array $data) {
                    foreach ($data['images'] as $src) {
                        Picture::create(['src' => $src]);
                    }

                    Notification::make()
                        ->title(count($data['images']) . ' pictures added')
                        ->success()
                        ->send();
                }),
        ];
    }
}
