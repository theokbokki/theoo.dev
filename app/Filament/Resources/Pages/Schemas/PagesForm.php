<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Models\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class PagesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('parent_id')
                ->label('Parent')
                ->relationship(
                    name: 'parent',
                    titleAttribute: 'path',
                    modifyQueryUsing: fn (Builder $query, ?Page $record) => $record
                        ? $query->whereKeyNot($record->getKey())->where('path', 'not like', $record->path.'/%')
                        : $query,
                )
                ->getOptionLabelFromRecordUsing(fn (Page $page) => $page->displayPath())
                ->searchable()
                ->preload()
                ->required(fn (): bool => Page::query()->exists())
                ->hidden(fn (?Page $record): bool => $record !== null && $record->parent_id === null),

            TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->autofocus(),

            MarkdownEditor::make('content')
                ->required()
                ->columnSpanFull(),
        ]);
    }
}
