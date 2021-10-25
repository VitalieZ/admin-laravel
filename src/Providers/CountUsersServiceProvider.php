<?php

namespace Viropanel\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\View;

class CountUsersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->ViewCountUsers();
    }

    protected function ViewCountUsers()
    {
        View::composer('admin::layouts.admin', function ($view) {
            $view->with('countUsers', User::count());
        });
    }
}
