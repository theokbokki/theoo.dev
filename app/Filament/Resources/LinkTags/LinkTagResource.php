<?php

namespace App\Filament\Resources\LinkTags;

use App\Filament\Resources\LinkTags\Pages\CreateLinkTag;
use App\Filament\Resources\LinkTags\Pages\EditLinkTag;
use App\Filament\Resources\LinkTags\Pages\ListLinkTags;
use App\Filament\Resources\LinkTags\Schemas\LinkTagForm;
use App\Filament\Resources\LinkTags\Tables\LinkTagsTable;
use App\Models\LinkTag;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LinkTagResource extends Resource
{
    protected static ?string $model = LinkTag::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LinkTagForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LinkTagsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLinkTags::route('/'),
            'create' => CreateLinkTag::route('/create'),
            'edit' => EditLinkTag::route('/{record}/edit'),
        ];
    }
}
