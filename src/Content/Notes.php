<?php

namespace Theoo\Content;

class Notes
{
    static function get(): array
    {
        return [
            static::addItem(
                'Teeth brushing',
                'teeth-brushing',
            ),
            static::addItem(
                'Books I read',
                'books-i-read',
            ),
            static::addItem(
                'Making a simple website with plain PHP',
                'making-a-simple-website-with-plain-php',
            ),
            static::addItem(
                'Exploring the small web',
                'exploring-the-small-web',
            ),
            static::addItem(
                'Simple PHP build system',
                'simple-php-build-system',
            ),
            static::addItem(
                'Seeing life through whimsical glasses',
                'seeing-life-through-whimsical-glasses',
            ),
            static::addItem(
                'My coding setup',
                'my-coding-setup',
            ),
        ];
    }

    protected static function addItem(string $name, string $src): object
    {
        return (object) [
            'name' => $name,
            'src' => $src,
        ];
    }
}
