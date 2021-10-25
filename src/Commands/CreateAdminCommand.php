<?php

namespace Viropanel\Admin\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class CreateAdminCommand extends Command
{
    protected $signature = 'admin-panel:create-admin 
        {name? : The name of the admin}
        {email? : The email of the admin}
        {password? : The password of the admin}';

    protected $description = 'Create user admin for admin panel';

    public function handle()
    {
        $admin = $this->CreateAdmin();
        $this->info($admin);
    }

    public function CreateAdmin()
    {
        $name = $this->argument('name') ?? config('admin::admin.create-damin.name');
        $email = $this->argument('email') ?? config('admin::admin.create-damin.email');
        $password = $this->argument('password') ?? config('admin::admin.create-damin.password');

        $isset_user = User::where('email', $email)->first();
        if (isset($isset_user)) {
            return "User exists with this email. Try again.\nemail: " . $email;
        }

        if ($name == config('admin::admin.create-damin.name') and $email == config('admin::admin.create-damin.email')) {
            $role = 'admin';
        } else {
            $this->call('permission:create-role', ['name' => 'user']);
            $role = 'user';
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->assignRole($role);

        return "Admin created:\nemail: " . $email . "\npassword`: " . $password;
    }
}
