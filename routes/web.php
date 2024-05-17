<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\UserRequestController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Rutas de Autenticación generadas por Auth::routes();
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\UserRequestController::class, 'user_home'])->name('home');
    Route::get('/requests/create', [UserRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests/store', [UserRequestController::class, 'store'])->name('requests.store');

    Route::get('/requests/{id}/edit', [UserRequestController::class, 'edit'])->name('requests.edit');

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/requests', [UserRequestController::class, 'index'])->name('requests.index');
        Route::get('/request/search', [UserRequestController::class, 'search'])->name('requests.search');

        Route::put('/requests/{id}', [UserRequestController::class, 'update'])->name('requests.update');
        Route::put('/requests/{id}/accept', [UserRequestController::class, 'accept'])->name('requests.accept');
        Route::put('/requests/{id}/decline', [UserRequestController::class, 'decline'])->name('requests.decline');
        Route::put('/requests/{id}/note', [UserRequestController::class, 'note'])->name('requests.note');
        Route::delete('/requests/{id}', [UserRequestController::class, 'destroy'])->name('requests.destroy');

        Route::get('/request/report', [UserRequestController::class, 'report'])->name('requests.report');
        Route::get('/request/export', [UserRequestController::class, 'export'])->name('requests.export');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/users/create', [RegisterController::class, 'showRegistrationForm'])->name('users.create');
        Route::post('/users/store', [RegisterController::class, 'store'])->name('users.store');
    });
});
