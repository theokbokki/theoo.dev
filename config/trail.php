<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Trail App Name
    |--------------------------------------------------------------------------
    |
    | The name of this Trail application. This value is used when the
    | application needs to display the name of the client within the UI
    | or in other locations.
    |
    */
    'name' => env('APP_NAME', 'Trail'),

    /*
    |--------------------------------------------------------------------------
    | Trail Client Routing & Middleware
    |--------------------------------------------------------------------------
    |
    | The application's graphical interface routing configuration. Both
    | domain and prefix (path) values are optional. If not provided, all UI routes
    | will be available starting from the root domain's `/` route.
    | The middleware will be assigned to every Trail "client" route. Most of the time
    | you should just stick with this stack.
    |
    */
    'client' => [
        'domain' => env('HIKER_DOMAIN', false),
        'prefix' => env('HIKER_PREFIX', 'admin'),
        'middleware' => [
            'web',
            Hiker\Http\Middleware\Authenticate::class,
            Hiker\Http\Middleware\DispatchRenderingTrailEvent::class,
            Hiker\Http\Middleware\BootProfiles::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Trail API Routing & Middleware
    |--------------------------------------------------------------------------
    |
    | The application's API routing configuration. Should be different from
    | the client's routing configuration.
    | The middleware will be assigned to every Trail "API" route. Most of the time
    | you should just stick with this stack.
    |
    */
    'api' => [
        'domain' => env('TRAIL_API_DOMAIN', false),
        'prefix' => env('TRAIL_API_PREFIX', 'api'),
        'middleware' => [
            'api',
            Hiker\Http\Middleware\Authenticate::class,
            Hiker\Http\Middleware\BootProfiles::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Relations with users
    |--------------------------------------------------------------------------
    |
    | Some of trail's database migrations are user-related. The following
    | settings provide customization options in order to keep the default
    | database migrations up-to-date with the application's actual "users" 
    | table.
    |
    */
    'users' => [
        // The "users" table name
        'table' => 'users',
        // The "users" table ID column type. 
        // Possible values: 'integer', 'uuid', 'ulid'
        'id' => 'integer', 
    ],
];
