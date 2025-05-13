<?php

namespace App\Enums;

enum Colors
{
    case Red;
    case Orange;
    case Yellow;
    case Green;
    case Blue;
    case Purple;
    case Pink;
    case Brown;

    public function bg(): string
    {
        return match($this) {
            self::Red => '248, 223, 234',
            self::Orange => '255, 247, 242',
            self::Yellow => '255, 252, 222',
            self::Green => '223, 248, 226',
            self::Blue => '223, 239, 248',
            self::Purple => '197, 183, 207',
            self::Pink => '255, 231, 253',
            self::Brown => '197, 180, 169',
        };
    }

    public function fg(): string
    {
        return match($this) {
            self::Red => '180, 0, 0',
            self::Orange => '200, 70, 0',
            self::Yellow => '125, 117, 0',
            self::Green => '0, 102, 14',
            self::Blue => '0, 102, 100',
            self::Purple => '56, 0, 102',
            self::Pink => '208, 0, 125',
            self::Brown => '75, 34, 5',
        };
    }

    /** @return array<int,string> */
    public static function getRandom(): array
    {
        $cases = self::cases();
        $randomCase = $cases[array_rand($cases)];

        return [$randomCase->bg(), $randomCase->fg()];
    }
}
