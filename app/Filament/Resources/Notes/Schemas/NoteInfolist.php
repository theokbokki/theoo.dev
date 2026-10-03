<?php

namespace App\Filament\Resources\Notes\Schemas;

use App\Models\Note;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class NoteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('subtitle')->size(TextSize::Large)->hiddenLabel()->columnSpanFull(),
            Section::make()
                ->schema([
                    TextEntry::make('created_at')->dateTime()->inlineLabel()->columnSpanFull(),
                    TextEntry::make('updated_at')->dateTime()->inlineLabel()->columnSpanFull(),
                    TextEntry::make('deleted_at')
                        ->dateTime()
                        ->inlineLabel()
                        ->columnSpanFull()
                        ->visible(fn(Note $record): bool => $record->trashed()),
                    TextEntry::make('status')->badge()->inlineLabel()->columnSpanFull(),
                ])
                ->columnSpanFull(),
            Section::make()
                ->schema([
                    TextEntry::make('content')->markdown()->hiddenLabel()->columnSpanFull(),
                ])
                ->columnSpanFull(),
        ]);
    }
}
