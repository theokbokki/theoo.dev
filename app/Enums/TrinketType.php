<?php

namespace App\Enums;

enum TrinketType: string
{
    case Design = 'design';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::Design => 'Design',
        };
    }
}
