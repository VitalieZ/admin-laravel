# Admin laravel CRUD

<p align="center">⛵<code>admin-laravel</code> is administrative interface builder for laravel which can help you build CRUD backends just with few lines of code.</p>

## Requirements

- PHP >= 7.0.0
- Laravel >= 8.0.0
- MySql

## Installation in empty project

> This package requires PHP 7+ and Laravel 8.0.0.

First, install laravel 8.0, and make sure that the database connection settings are correct.

```
composer require viropanel/admin-laravel
```

After install configure file `.env` for db connection.

For automatic installation and configure use this command：

```
php artisan admin-panel:empty-project
```

Open `http://localhost/admin/` in browser,use username `admin@admin.loc` and password `12345678` to login.

## Multilanguage

If you need localization set `'localization' => true` from `config/admin.php`.
Default languege is only `en` optional you can use `ro` and `ru`, or use optional only one `ru` or `ro`

For categories

```
'category' => [
    'localization' => true
    'lang' => ['ru', 'ro']
],
```

For menu admin

```
'menu_admin' => [
    'localization' => true,
    'lang' => ['ru', 'ro']
]
```
