<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', App\Livewire\Dashboard::class)->name('dashboard');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', App\Livewire\User::class)->name('index');
    });
});
