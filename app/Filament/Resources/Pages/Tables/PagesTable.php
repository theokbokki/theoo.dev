<?php

namespace App\Filament\Resources\Pages\Tables;

use App\Models\Page;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('path')
                    ->state(fn (Page $record) => $record->displayPath())
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable(),

                TextColumn::make('updated_at')
                    ->since()
                    ->sortable(),

                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                TrashedFilter::make(),
            ])
            ->checkIfRecordIsSelectableUsing(fn (Page $record): bool => $record->parent_id !== null)
            ->recordActions([
                Action::make('open')
                    ->url(fn (Page $record) => $record->url(), shouldOpenInNewTab: true)
                    ->visible(fn (Page $record): bool => ! $record->trashed()),

                EditAction::make(),

                DeleteAction::make()
                    ->visible(fn (Page $record): bool => $record->parent_id !== null),

                RestoreAction::make(),

                ForceDeleteAction::make()
                    ->visible(fn (Page $record): bool => $record->parent_id !== null),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
