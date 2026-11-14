<?php

namespace App\Filament\Resources\LinkTags\Pages;

use App\Filament\Resources\LinkTags\LinkTagResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLinkTags extends ListRecords
{
    protected static string $resource = LinkTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
