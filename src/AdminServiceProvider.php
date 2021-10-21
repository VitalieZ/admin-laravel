<?php

namespace Viropanel\Admin;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;
use Laravel\Ui\UiCommand;


class AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'admin');
        $this->publishes([__DIR__ . '/config/admin.php' => config_path('admin.php')]);
        $this->publishes([__DIR__ . '/config' => config_path()], 'laravel-admin-config');
        $this->publishes([__DIR__ . '/resources/assets' => public_path('assets'),], 'public');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations', 'admin');
        $this->publishes([__DIR__ . '/database/migrations' => database_path('migrations')], 'migrations');

        UiCommand::macro('admin', function (UiCommand $command) {
            $adminPreset = new AdminPreset($command);

            if ($command->option('auth')) {
                $adminPreset->installAuth();
                $command->info('Admin CSS auth scaffolding installed successfully.');
            }

            $command->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
        });
    }

    public function register()
    {
    }
}
