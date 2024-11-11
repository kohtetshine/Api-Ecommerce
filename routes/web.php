<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\AuthAdmin;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');


Route::prefix('user')->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.dashboard');
})->middleware('auth');


Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
})->middleware('auth',AuthAdmin::class);
