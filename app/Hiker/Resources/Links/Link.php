<?php

namespace App\Hiker\Resources\Links;

use Hiker\Components\Icon\Icon;
use Hiker\Resource;

class Link extends Resource
{
    /**
     * Get the resource singular display label
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Link';
    }

    /**
     * Get the resource plural display label
     *
     * @return string
     */
    public static function pluralLabel()
    {
        return 'Links';
    }

    /**
     * Get the resource's default icon
     *
     * @return null|string
     */
    public static function icon()
    {
        return Icon::make('link-external');
    }

    /**
     * Get the full list of available columns for display
     */
    public static function getAvailableColumns(): array
    {
        return [
            Attributes\CreatedAt::class,
            Attributes\Description::class,
            Attributes\Url::class,
        ];
    }

    /**
     * Get the columns to be displayed by default
     */
    public static function getDefaultColumns(): array
    {
        return [
            'created_at',
            'description',
            'url',
        ];
    }

    /**
     * Get the default order by config
     */
    public static function getDefaultOrderColumn(): string
    {
        return 'created_at';
    }
}
