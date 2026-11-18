<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum BookStatus: string implements HasLabel, HasColor
{
    case Wishlist = 'wishlist';
    case ToRead = 'to-read';
    case Reading = 'reading';
    case Read = 'read';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Wishlist => 'Wishlist',
            self::ToRead => 'To read',
            self::Reading => 'Reading',
            self::Read => 'Read',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Wishlist => Color::Fuchsia,
            self::ToRead => Color::Orange,
            self::Reading => Color::Blue,
            self::Read => Color::Green,
        };
    }
}
