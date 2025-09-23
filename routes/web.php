<?php

use App\Http\Controllers\views\AuthController;
use App\Http\Controllers\views\DashboardController;

Route::get('/', function () {return view('layouts.welcome.index');})->name('welcome');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->name('dashboard')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('.index');
    //Route::get('/rooms', [DashboardController::class, 'rooms'])->name('.rooms');
    Route::get('/room/{id}', [DashboardController::class, 'room'])->name('.room');
    Route::get('/plant/{id}', [DashboardController::class, 'plant'])->name('.plant');
});

require __DIR__.'/auth.php';
