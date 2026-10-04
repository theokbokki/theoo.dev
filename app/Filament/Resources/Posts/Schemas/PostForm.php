<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Attachment;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Textarea::make('content')->required()->columnSpanFull(),

            Attachment::repeater(),
        ]);
    }
}
