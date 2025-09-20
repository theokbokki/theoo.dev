<?php

function getTheme(): string
{
    $themes = [
        'red',
        'orange',
        'yellow',
        'green',
        'blue',
        'purple',
        'pink',
    ];

    return $themes[array_rand($themes)];
}
