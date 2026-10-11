<?php

namespace App\Filament\Resources\Links\Schemas;

use App\Enums\LinkCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('url')->required()->columnSpanFull(),

            TextInput::make('description')->required()->columnSpanFull(),

            Select::make('category')->options(LinkCategory::class)->required()->columnSpanFull(),
        ]);
    }
}
