<?php

namespace Viropanel\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Viropanel\Admin\Http\Controllers\CategoryController;

Auth::routes();

Route::prefix(config('admin.route.prefix'))->middleware([config('admin.route.middleware')])->group(function () {
    Route::get('/', function () {
        return view('admin::admin.dashboard');
    });

    //Category
    Route::resource('menu', CategoryController::class);
});
