<?php

namespace Viropanel\Admin\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class CreateAdminCommand extends Command
{
    protected $signature = 'admin-panel:create-admin';

    protected $description = 'Create user admin for admin panel';

    public function handle()
    {
        $admin = $this->CreateAdmin();
        $this->info($admin);
    }

    public function CreateAdmin()
    {
        $name = 'admin';
        $email = 'admin@admin.loc';
        $password = '12345678';

        $isset_user = User::where('email', $email)->orWhere('name', $name)->first();
        if (isset($isset_user)) {
            return "User exists.";
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->assignRole('admin');

        return "Admin created:\nemail: " . $email . "\npassword`: " . $password;
    }
}
