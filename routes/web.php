<?php

use Illuminate\Support\Facades\Route;
use Atif\RoleManager\Http\Controllers\RoleController;
use Atif\RoleManager\Http\Controllers\PermissionController;

Route::group([
    'prefix' => config('RoleManager.route_prefix', 'admin/roles'),
    'middleware' => config('RoleManager.middleware', ['web', 'auth']),
], function () {
    // Role Routes
    Route::get('/', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Permission Routes
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('/{id}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });
});
