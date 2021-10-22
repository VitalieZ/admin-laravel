<?php

namespace Viropanel\Admin\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class InstallForEmptyProject extends Command
{
    protected $signature = 'admin-panel:empty-project {--name?} {--email?} {--password?}';

    protected $description = 'Create admin for admin panel';

    public function handle()
    {
        $admin = $this->CreateAdmin();
        $this->info($admin);
    }

    public function CreateAdmin()
    {
        $name = $this->argument('mame') ?? 'Admin';
        $email = $this->argument('email') ?? 'admin@admin.loc';
        $password = $this->argument('password') ?? '12345678';

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $user->assignRole('admin');

        return "Admin create: `email: `" . $email . " and `password: `" . $password;
    }
}
