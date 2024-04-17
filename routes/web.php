<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/github/redirect', [LoginController::class, 'githubRedirect'])->name('github.redirect');
Route::get('/github/callback', [LoginController::class, 'githubCallback'])->name('github.callback');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/json-export', [DashboardController::class, 'jsonExport'])->name('json.export');
});
