<?php

namespace Viropanel\Admin\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Viropanel\Admin\AdminPreset;


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
        $this->createRolePermission();
        $this->createAdminUser();
    }

    public function artisanComand()
    {
        $this->call('ui:auth');
        $adminPreset = new AdminPreset();
        $adminPreset->installAuth();
        $this->call('vendor:publish', ['--provider' => 'Viropanel\Admin\AdminServiceProvider']);
        $this->call('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider']);
        $this->call('optimize:clear');
        $this->call('migrate');
    }

    public function copyFileWithChengeCode()
    {
        File::copy(__DIR__ . '/../Http/Kernel.php', base_path('/app/Http/Kernel.php'));
        //File::copy(__DIR__ . '/../Models/User.php', base_path('/app/Models/User.php'));
        File::copy(__DIR__ . '/../Providers/RouteServiceProvider.php', base_path('/app/Providers/RouteServiceProvider.php'));
    }

    public function createRolePermission()
    {
        $this->call('permission:create-role', ['name' => 'admin']);
        $this->call('permission:create-role', ['name' => 'user']);
        $this->call('permission:create-permission', ['name' => ' access_admin_panel']);
        $this->call('admin-panel:insset-permisions');
    }

    public function createAdminUser()
    {
        $this->call('admin-panel:create-admin');
    }
}
