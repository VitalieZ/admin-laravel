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

        $isset_permision = Permission::where('name', 'categoty_acces')->first();
        if (isset($isset_permision)) {
            return "All permissions already inserted";
        }
        $i = 0;

        foreach ($this->perforadminpanel() as $item) {
            $this->call('permission:create-permission', ['name' => $item[$i]]);
            $i++;
        }

        return "All permissions added.";
    }

    protected function perforadminpanel()
    {
        return [
            'category_access',
            'category_show',
            'category_create',
            'category_edit',
            'category_delete',
        ];
    }
}
