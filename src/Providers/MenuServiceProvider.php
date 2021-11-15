<?php

namespace Viropanel\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Viropanel\Admin\Models\Menuadmin;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;

class MenuServiceProvider extends ServiceProvider
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
        $this->Menu();
    }

    protected function Menu()
    {
        View::composer('admin::layouts.admin', function ($view) {
            $view->with('menu', $this->menuadmin());
        });
    }

    public function menuadmin()
    {
        return App::make(MenuAdmin::class)->getMenuadmin();
    }
}
