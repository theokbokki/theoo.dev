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
        ]);
    }
}
