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

    //Users
    Route::post('users/destroy', [\Viropanel\Admin\Http\Controllers\UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('user', \Viropanel\Admin\Http\Controllers\UsersController::class);

    //Roles
    Route::delete('roles/destroy', [\Viropanel\Admin\Http\Controllers\RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', \Viropanel\Admin\Http\Controllers\RolesController::class);

    // Permissions
    Route::delete('permissions/destroy', [\Viropanel\Admin\Http\Controllers\PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', \Viropanel\Admin\Http\Controllers\PermissionsController::class);
});
