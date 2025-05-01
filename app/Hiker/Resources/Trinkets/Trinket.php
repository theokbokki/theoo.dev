<?php

namespace App\Hiker\Resources\Trinkets;

use Hiker\Components\Icon\Icon;
use Hiker\Components\Text\Text;
use Hiker\Resource;
use Hiker\Structures\Archive\Attribute;

class Trinket extends Resource
{
    /**
     * Get the resource singular display label
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Trinket';
    }

    /**
     * Get the resource plural display label
     *
     * @return string
     */
    public static function pluralLabel()
    {
        return 'Trinkets';
    }

    /**
     * Get the resource's default icon
     *
     * @return null|string
     */
    public static function icon()
    {
        return Icon::make('image');
    }

    /**
     * Get the full list of available columns for display
     *
     * @return array
     */
    public static function getAvailableColumns(): array
    {
        return [
            Attributes\Type::class,
            Attributes\Src::class,
        ];
    }


    /**
     * Get the columns to be displayed by default
     *
     * @return array
     */
    public static function getDefaultColumns(): array
    {
        return [
            'type',
            'src',
        ];
    }

    /**
     * Get the default order by config
     *
     * @return string
     */
    public static function getDefaultOrderColumn(): string
    {
        return 'type';
    }
}
