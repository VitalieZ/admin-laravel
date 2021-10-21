<?php

namespace Viropanel\Admin;

use Illuminate\Support\Facades\Route;
use Viropanel\Admin\Http\Controllers\CategoryController;

Route::prefix(config('admin.route.prefix'))->middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('admin::admin.dashboard');
    });

    //Category
    Route::resource('menu', CategoryController::class);
});
