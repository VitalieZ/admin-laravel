<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin name
    |--------------------------------------------------------------------------
    |
    | This value is the name of laravel-admin, This setting is displayed on the
    | login page.
    |
    */
    'name' => 'Laravel-admin',

    /*
    |--------------------------------------------------------------------------
    | Details admin register for command admin-panel:create-admin name email password
    |--------------------------------------------------------------------------
    */
    'create-damin' => [
        'name' => 'Admin',
        'email' => 'admin@admin.loc',
        'password' => '12345678',
    ],


    /*
    |--------------------------------------------------------------------------
    | Laravel-admin logo
    |--------------------------------------------------------------------------
    |
    | The logo of all admin pages. You can also set it as an image by using a
    | `url`, eg 'assets/dist/img/AdminLTELogo.png'.
    |
    */
    'logo' => '/assets/dist/img/AdminLTELogo.png',

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin route settings
    |--------------------------------------------------------------------------
    |
    | The routing configuration of the admin page, including the path prefix,
    | the controller namespace, and the default middleware. If you want to
    | access through the root path, just set the prefix to empty string.
    |
    */
    'route' => [

        'prefix' => 'admin',

        'middleware' => 'role_or_permission:admin|access_admin_panel',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin database settings
    |--------------------------------------------------------------------------
    |
    | Here are database settings for laravel-admin builtin model & tables.
    |
    */
    'database' => [

        // Pivot table for table above.
        'menu_table' => 'admin_menu',
        'categories_table' => 'categories',
    ],
];
