<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum LinkCategory: string implements HasLabel, HasColor
{
    case Friends = 'friends';
    case Cool = 'cool';
    case Articles = 'articles';
    case Collections = 'collections';
    case Personal = 'personal';
    case Tool = 'tool';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Friends => 'Friends',
            self::Cool => 'Cool',
            self::Articles => 'Articles',
            self::Collections => 'Collections',
            self::Personal => 'Personal',
            self::Tool => 'Tool',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Friends => Color::Pink,
            self::Cool => Color::Amber,
            self::Articles => Color::Blue,
            self::Collections => Color::Lime,
            self::Personal => Color::Olive,
            self::Tool => Color::Purple,
        };
    }

    public function getOrder(): int
    {
        return match ($this) {
            self::Friends => 1,
            self::Cool => 2,
            self::Articles => 3,
            self::Collections => 4,
            self::Personal => 5,
            self::Tool => 6,
        };
    }
}
