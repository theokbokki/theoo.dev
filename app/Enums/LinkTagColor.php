<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum LinkTagColor: string implements HasLabel, HasColor
{
    case Red = 'red';
    case Orange = 'orange';
    case Yellow = 'yellow';
    case Green = 'green';
    case Blue = 'blue';
    case Purple = 'purple';
    case Pink = 'pink';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Red => 'Red',
            self::Orange => 'Orange',
            self::Yellow => 'Yellow',
            self::Green => 'Green',
            self::Blue => 'Blue',
            self::Purple => 'Purple',
            self::Pink => 'Pink',
        };
    }

    public function getHue(): int
    {
        return match ($this) {
            self::Red => 0,
            self::Orange => 19,
            self::Yellow => 50,
            self::Green => 120,
            self::Blue => 234,
            self::Purple => 280,
            self::Pink => 320,
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Red => Color::Red,
            self::Orange => Color::Orange,
            self::Yellow => Color::Yellow,
            self::Green => Color::Green,
            self::Blue => Color::Blue,
            self::Purple => Color::Purple,
            self::Pink => Color::Pink,
        };
    }
}
