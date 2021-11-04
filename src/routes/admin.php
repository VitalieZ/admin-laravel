<?php

namespace Viropanel\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Viropanel\Admin\Http\Controllers\CategoryController;

Auth::routes();

Route::prefix(config('admin.route.prefix'))->middleware([config('admin.route.middleware')])->group(function () {
    Route::get('/', [\Viropanel\Admin\Http\Controllers\DashboardController::class, 'index']);

    //Category
    Route::get('menu/list', [\Viropanel\Admin\Http\Controllers\CategoryController::class, 'viewManuList'])->name('menu.list');
    Route::get('menu/select', [\Viropanel\Admin\Http\Controllers\CategoryController::class, 'viewSelectForm'])->name('menu.select');
    Route::post('/categoryorderingsave', [CategoryController::class, 'categoryorderingsave'])->name('orderingcategory');
    Route::post('/massDestroy', [CategoryController::class, 'massDestroy'])->name('massDestroy');
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

    //Menu admin
    Route::get('menu-admin/list', [\Viropanel\Admin\Http\Controllers\MenuadminController::class, 'viewMenuList'])->name('menu-admin.list');
    Route::get('menu-admin/select', [\Viropanel\Admin\Http\Controllers\MenuadminController::class, 'viewSelectForm'])->name('menu-admin.select');
    Route::post('menu-admin/categoryorderingsave', [\Viropanel\Admin\Http\Controllers\MenuadminController::class, 'categoryorderingsave'])->name('menu-admin.orderingcategory');
    Route::post('menu-admin/massDestroy', [\Viropanel\Admin\Http\Controllers\MenuadminController::class, 'massDestroy'])->name('menu-admin.massDestroy');
    Route::resource('menu-admin', \Viropanel\Admin\Http\Controllers\MenuadminController::class);
});
