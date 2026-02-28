<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Route Configuration
    |--------------------------------------------------------------------------
    |
    | These options control the route settings for the Role Manager UI.
    |
    */
    'route_prefix' => 'admin/roles',
    'middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Layout Configuration
    |--------------------------------------------------------------------------
    |
    | This is the layout that your role manager views will extend.
    |
    */
    'layout' => 'layouts.app',

    /*
    |--------------------------------------------------------------------------
    | Default Guard
    |--------------------------------------------------------------------------
    |
    | The default guard to use when managing roles and permissions.
    |
    */
    'guard' => 'web',
];