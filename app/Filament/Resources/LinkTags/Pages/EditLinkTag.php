<?php

namespace App\Filament\Resources\LinkTags\Pages;

use App\Filament\Resources\LinkTags\LinkTagResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLinkTag extends EditRecord
{
    protected static string $resource = LinkTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
