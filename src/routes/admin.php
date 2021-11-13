<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Viropanel\Admin\Http\Controllers\CategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Auth::routes();

Route::prefix(LaravelLocalization::setLocale() . '/' . config('admin.route.prefix'))->middleware([config('admin.route.middleware')])->group(function () {
    Route::get('/', [\Viropanel\Admin\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');

    //Category
    Route::get('menu/list', [\Viropanel\Admin\Http\Controllers\CategoryController::class, 'viewMenuList'])->name('menu.list');
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
    Route::get('menua/list', [\Viropanel\Admin\Http\Controllers\MenuaController::class, 'viewMenuList'])->name('menua.list');
    Route::get('menua/select', [\Viropanel\Admin\Http\Controllers\MenuaController::class, 'viewSelectForm'])->name('menua.select');
    Route::post('menua/categoryorderingsave', [\Viropanel\Admin\Http\Controllers\MenuaController::class, 'categoryorderingsave'])->name('menua.orderingcategory');
    Route::post('menua/massDestroy', [\Viropanel\Admin\Http\Controllers\MenuaController::class, 'massDestroy'])->name('menua.massDestroy');
    Route::resource('menus', \Viropanel\Admin\Http\Controllers\MenuaController::class);
});
