<?php

namespace Viropanel\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder
{
    public function admin_register()
    {
        new CreateAdminSeeder();
    }

    public function add_role_admin()
    {
        new RoleAdminSeeder();
    }

    public function has_role_mode()
    {
    }
}
