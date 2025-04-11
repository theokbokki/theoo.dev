<?php

namespace App\Hiker\Resources\Notes;

use Hiker\Components\Icon\Icon;
use Hiker\Resource;

class Note extends Resource
{
    /**
     * Get the resource singular display label
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Note';
    }

    /**
     * Get the resource plural display label
     *
     * @return string
     */
    public static function pluralLabel()
    {
        return 'Notes';
    }

    /**
     * Get the resource's default icon
     *
     * @return null|string
     */
    public static function icon()
    {
        return Icon::make('pencil');
    }

    /**
     * Get the full list of available columns for display
     *
     * @return array
     */
    public static function getAvailableColumns(): array
    {
        return [
            Attributes\Published::class,
            Attributes\Title::class,
            Attributes\CreatedAt::class,
            Attributes\UpdatedAt::class,
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
            'published',
            'title',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Get the default order by config
     *
     * @return string
     */
    public static function getDefaultOrderColumn(): string
    {
        return 'updated_at';
    }
}
