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
            static::addItem(
                'Tinker password change one liner',
                'tinker-password-change-one-liner',
            ),
            static::addItem(
                'Link to a specific place in a .txt file',
                'link-to-a-specific-place-in-a-txt-file',
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
