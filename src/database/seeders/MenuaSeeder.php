<?php

namespace Viropanel\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class MenuaSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('menu_admin')) {
            $not_empty = DB::table('menu_admin')->select("name")->first();
            if (empty($not_empty)) {
                foreach ($this->data() as $item) {
                    DB::table('menu_admin')->insert([
                        'parent_id' => $item[0],
                        'ordering' => $item[1],
                        'name' => $item[2],
                        'icon' => $item[3],
                        'uri' => $item[4],
                        'permission' => $item[6],
                        'visible' => $item[7],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
        }
    }

    public function data()
    {
        $menu = array(
            [0, 0, 'Dashboard', 'fa fa-bar-chart', 'admin.dashboard', 'dashboard_access', 1],
            [0, 1, 'Categories', 'fas fa-bars', 'menu.index', 'category_access', 1],
            [0, 2, 'Admin', 'fas fa-user-md', '', 'Admin', 'user_management_access', 1],
            [3, 0, 'Menu', 'fas fa-bars', 'menus.index', 'menu_admin_access', 1],
            [3, 1, 'Users', 'fas fa-users', 'user.index', 'user_access', 1],
            [3, 2, 'Roles', 'fas fa-user-tag', 'roles.index', 'role_access', 1],
            [3, 3, 'Permissions', 'fas fa-user-check', 'permissions.index', 'permission_access', 1],
        );
        return $menu;
    }
}
