<?php

namespace Viropanel\Admin;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;
use Laravel\Ui\UiCommand;
use Illuminate\Support\Collection;
use File;


class AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //$this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'admin');
        $this->publishes([__DIR__ . '/config/admin.php' => config_path('admin.php')]);
        $this->publishes([__DIR__ . '/config' => config_path()], 'laravel-admin-config');
        $this->publishes([__DIR__ . '/resources/assets' => public_path('assets'),], 'public');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations', 'admin');
        $this->publishes([__DIR__ . '/database/migrations' => database_path('migrations')], 'migrations');


        UiCommand::macro('admin-panel', function (UiCommand $command) {
            $adminPreset = new AdminPreset($command);
            $adminEmptyProject = new AdminEmptyProject($command);

            if ($command->option('auth')) {
                $adminPreset->installAuth();
                $command->info('Admin CSS auth scaffolding installed successfully.');
            }

            if ($command->option('empty-project')) {
                $adminEmptyProject->installEmptyProject();
                $command->info('Admin files configured successfull.');
            }
        });
    }

    public function register()
    {
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @return string
     */
    protected function getMigrationFileName($migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make($this->app->databasePath() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $migrationFileName) {
                return $filesystem->glob($path . '*_' . $migrationFileName);
            })
            ->push($this->app->databasePath() . "/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
