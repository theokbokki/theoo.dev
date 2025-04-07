<?php

return [
    /*
     * Custom scripts to include in the page
     */
    'scripts' => [
        // 'js/components.js'
    ],

    /*
     * Custom styles to include in the page
     */
    'styles' => [
        // 'css/components.css'
    ],

    /*
     * The locales to use for translatable fields
     */
    'locales' => [
        // 'fr' => 'Français',
        // 'nl' => 'Néerlandais'
    ],

    /*
     * Define Hiker's file storage behavior.
     */
    'storage' => [
        'tmp' => [
            'disk' => env('HIKER_TMP_DISK', 'public'),
            'directory' => env('HIKER_TMP_DIRECTORY', 'tmp'),
        ],
    ],
];
