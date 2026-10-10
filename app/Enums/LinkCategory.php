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

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Friends => 'Friends',
            self::Cool => 'Cool',
            self::Articles => 'Articles',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Friends => Color::Pink,
            self::Cool => Color::Amber,
            self::Articles => Color::Blue,
        };
    }
}
