<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\UserRequestController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Rutas de Autenticación generadas por Auth::routes();
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/password', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/requests/create', [UserRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests/store', [UserRequestController::class, 'store'])->name('requests.store');

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/requests', [UserRequestController::class, 'index'])->name('requests.index');
        Route::get('/requests/{id}/edit', [UserRequestController::class, 'edit'])->name('requests.edit');
        Route::put('/requests/{id}', [UserRequestController::class, 'update'])->name('requests.update');
        Route::put('/requests/{id}/accept', [UserRequestController::class, 'accept'])->name('requests.accept');
        Route::delete('/requests/{id}', [UserRequestController::class, 'destroy'])->name('requests.destroy');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/users/create', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('users.create');
        Route::post('/users/store', 'App\Http\Controllers\Auth\RegisterController@store')->name('users.store');

        Route::get('/request/report', [UserRequestController::class, 'report'])->name('requests.report');

        Route::get('/request/export', [UserRequestController::class, 'export'])->name('requests.export');
    });
});
