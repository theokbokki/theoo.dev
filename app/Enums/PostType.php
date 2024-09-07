<?php

namespace App\Enums;

enum PostType: string
{
    case PROJECT = 'project';
    case ARTICLE = 'article';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
