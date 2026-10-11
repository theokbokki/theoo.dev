<?php

namespace App\Filament\Resources\Links\Tables;

use App\Models\Link;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('favicon')->disk('public')->imageHeight(24)->square(),

                TextColumn::make('url')
                    ->sortable()
                    ->description(fn(Link $record): string => $record->description ?? '')
                    ->searchable(),

                TextColumn::make('category')->sortable()->badge()->searchable(),

                TextColumn::make('created_at')->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
