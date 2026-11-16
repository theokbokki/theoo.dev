<?php

namespace App\Filament\Resources\LinkTags\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Enums\LinkTagColor;

class LinkTagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->columnSpanFull(),

                Select::make('hue')
                    ->options(LinkTagColor::class)
                    ->required(),
            ]);
    }
}
