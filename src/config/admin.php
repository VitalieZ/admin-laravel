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
    | the controller namespace, and the default middleware.
    |
    */
    'route' => [

        'prefix' => 'admin',

        'middleware' => 'role_or_permission:admin|access_admin_panel',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin categories settings
    |--------------------------------------------------------------------------
    |
    | If you want to use more languages for your categories you must set 'localization' => true.
    | You can use ru and ro for additional 2 languages or you can delete one if you don't need it.
    |
    */
    'category' => [
        'localization' => false, //true or false
        'lang' => ['ru', 'ro'], // `ro` and `ru`, or use only one `ru` or `ro`
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin menu admin settings
    |--------------------------------------------------------------------------
    |
    | If you want to use more languages for your menu admin you must set 'localization' => true.
    | You can use ru and ro for additional 2 languages or you can delete one if you don't need it.
    |
    */
    'menu_admin' => [
        'localization' => false, //true or false
        'lang' => ['ru', 'ro'], // `ro` and `ru`, or use only one `ru` or `ro`
    ]
];
