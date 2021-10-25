<?php

namespace Viropanel\Admin;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Laravel\Ui\UiCommand;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Viropanel\Admin\Http\Livewire\Category\CategoryCreate;
use Viropanel\Admin\Http\Livewire\Permissions\SearchPermissions;


class AdminServiceProvider extends ServiceProvider
{

    protected $routeMiddleware = [
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
    ];

    public function boot()
    {
        $this->commands([
            Commands\InstallForEmptyProject::class,
            Commands\InsertBasePermissionsCommand::class,
            Commands\CreateAdminCommand::class
        ]);

        /*Load Translations */
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'admin');

        /*Load Views */
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'admin');

        /* Publishing Configuration */
        $this->publishes([__DIR__ . '/config/admin.php' => config_path('admin.php')]);
        $this->publishes([__DIR__ . '/config' => config_path()], 'admin');

        /* Publishing Public Assets */
        $this->publishes([__DIR__ . '/resources/assets' => public_path('assets'),], 'public');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations', 'admin');
        $this->publishes([
            __DIR__ . '/database/migrations/create_admin_tables.php.stub' => $this->getMigrationFileName('create_admin_tables.php'),
        ], 'migrations');

        UiCommand::macro('admin', function (UiCommand $command) {
            $adminPreset = new AdminPreset($command);

            if ($command->option('auth')) {
                $adminPreset->installAuth();
                $command->info('Admin CSS auth scaffolding installed successfully.');
            }
        });

        /* Super admin all permissions */
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });

        //register livewire components
        $this->livewireComponents();
    }


    public function register()
    {
    }

    public function livewireComponents()
    {
        \Livewire::component('admin::categorycreate', CategoryCreate::class);
        \Livewire::component('admin::search-permisions', SearchPermissions::class);
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
