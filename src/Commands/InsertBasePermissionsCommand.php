<?php

namespace Viropanel\Admin\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;


class InsertBasePermissionsCommand extends Command
{
    protected $signature = 'admin-panel:insset-permisions';

    protected $description = 'Inssert in db all permisions for start admin-panel';

    public function handle()
    {
        $admin = $this->PermisonsAdminPanel();
        $this->info($admin);
    }

    public function PermisonsAdminPanel()
    {

        foreach ($this->perforadminpanel() as $value) {
            $this->call('permission:create-permission', ['name' => $value]);
        }


        return "All permissions added.";
    }

    protected function perforadminpanel()
    {
        $permissions = array(
            "category_access",
            "category_show",
            "category_create",
            "category_edit",
            "category_delete",
            "user_access",
            "user_show",
            "user_create",
            "user_edit",
            "user_delete",
            "role_access",
            "role_show",
            "role_create",
            "role_edit",
            "role_delete",
            "permission_access",
            "permission_show",
            "permission_create",
            "permission_edit",
            "permission_delete"

        );
        return $permissions;
    }
}
