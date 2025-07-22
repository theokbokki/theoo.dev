<?php

function asset(string $name): string
{
    static $manifest = null;

    if ($manifest === null) {
        $content = file_get_contents(__DIR__.'/../public/manifest.json');
        $manifest = json_decode($content, true);
    }

    if (isset($manifest[$name])) {
        return '/'.$manifest[$name];
    }

    return '/assets/'.$name;
}
