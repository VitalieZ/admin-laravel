<?php

namespace Viropanel\Admin;

use Illuminate\Support\Facades\Artisan;
use File;
use Viropanel\Admin\Database\Seeders\AdminSeeder;
use Viropanel\Admin\Database\Seeders\CreateAdminSeeder;
use Viropanel\Admin\Database\Seeders\HasRoleAdminSeeder;

class AdminEmptyProject
{

    public function installEmptyProject()
    {
        $this->artisanComand();
        $this->copyFileWithChengeCode();

        new CreateAdminSeeder();

        $this->createRolePermission();

        new HasRoleAdminSeeder();
    }

    public function artisanComand()
    {
        Artisan::call('ui:auth');
        Artisan::call('ui:admin-panel --auth');
        Artisan::call('vendor:publish --provider="Viropanel\Admin\AdminServiceProvider"');
        Artisan::call('vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"');
        Artisan::call('optimize:clear');
        Artisan::call('migrate');
    }

    public function copyFileWithChengeCode()
    {
        File::copy(__DIR__ . '/Http/Kernel.php', base_path('/app/Http/Kernel.php'));
        File::copy(__DIR__ . '/Models/User.php', base_path('/app/Models/User.php'));
        File::copy(__DIR__ . '/Providers/RouteServiceProvider.php', base_path('/app/Providers/RouteServiceProvider.php'));
    }

    public function createRolePermission()
    {
        Artisan::call('permission:create-role admin');
        Artisan::call('permission:create-permission access_admin_panel');
    }
}
