<?php

function getLocaleForLanguage(string $language): string
{
    return match ($language) {
        'English' => 'en',
        'French' => 'fr',
        default => 'en',
    };
}
