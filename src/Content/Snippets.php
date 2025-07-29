<?php

namespace Theoo\Content;

class Snippets
{
    static function get(): array
    {
        return [
            static::addItem(
                'Circle under mouse—GLSL',
                'circle-under-mouse-glsl',
            ),
            static::addItem(
                'Default Pluton class—JS',
                'default-pluton-class-js',
            ),
            static::addItem(
                'Neovim find and replace snippets',
                'neovim-find-and-replace-snippets',
            ),
            static::addItem(
                'Trait to generate gradients–PHP',
                'trait-to-generate-gradients-php',
            ),
            static::addItem(
                'Useful Makefile rules',
                'useful-makefile-rules',
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
