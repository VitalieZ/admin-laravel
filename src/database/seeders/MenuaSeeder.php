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
                        'title' => $item[5],
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
            [0, 0, 'Dashboard', 'fa fa-bar-chart', 'admin.dashboard', 'Dashboard', 'dashboard_access', 1],
            [0, 1, 'Категорий', 'fas fa-bars', 'menu.index', 'Категорий', 'category_access', 1],
            [0, 2, 'Admin', 'fas fa-user-md', '', 'Admin', 'user_management_access', 1],
            [3, 0, 'Меню', 'fas fa-bars', 'menus.index', 'Меню админ', 'menu_admin_access', 1],
            [3, 1, 'Пользыватель', 'fas fa-users', 'user.index', 'Пользыватель', 'user_access', 1],
            [3, 2, 'Роль', 'fas fa-user-tag', 'roles.index', 'Роль', 'role_access', 1],
            [3, 3, 'Разрешение', 'fas fa-user-check', 'permissions.index', 'Разрешение', 'permission_access', 1],
        );
        return $menu;
    }
}
