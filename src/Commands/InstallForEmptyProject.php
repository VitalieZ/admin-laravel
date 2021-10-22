<?php

namespace Viropanel\Admin\Commands;

use Illuminate\Console\Command;
use File;
use Viropanel\Admin\Database\Seeders\CreateAdminSeeder;
use Viropanel\Admin\Database\Seeders\HasRoleAdminSeeder;


class InstallForEmptyProject extends Command
{
    protected $signature = 'admin-panel:empty-project';

    protected $description = 'Chenge files to project';

    public function handle()
    {
        $this->installEmptyProject();
        $this->info("Role created");
    }

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
        $this->call('ui:auth');
        //$this->call('ui:admin', ['--auth']);
        $this->call('vendor:publish', ['--provider' => 'Viropanel\Admin\AdminServiceProvider']);
        $this->call('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider']);
        $this->call('optimize:clear');
        $this->call('migrate');
    }

    public function copyFileWithChengeCode()
    {
        File::copy(__DIR__ . '/Http/Kernel.php', base_path('/app/Http/Kernel.php'));
        File::copy(__DIR__ . '/Models/User.php', base_path('/app/Models/User.php'));
        File::copy(__DIR__ . '/Providers/RouteServiceProvider.php', base_path('/app/Providers/RouteServiceProvider.php'));
    }

    public function createRolePermission()
    {
        $this->call('permission:create-role admin');
        $this->call('permission:create-permission access_admin_panel');
    }
}
