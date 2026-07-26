<?php

use App\Http\Controllers\Admin\InstagramController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\InstagramFeedController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');
Route::get('/instagram-feed', InstagramFeedController::class)->name('instagram.feed');
Route::get('/instagram/callback', [InstagramController::class, 'callback'])->name('instagram.callback');

// Auth Routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Logout Route (Authenticated)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', App\Livewire\Dashboard::class)->name('dashboard');
    Route::get('/profile', App\Livewire\Profile::class)->name('profile');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', App\Livewire\User::class)->name('index');
    });

    Route::prefix('banners')->name('banners.')->group(function () {
        Route::get('/', App\Livewire\Banner::class)->name('index');
    });

    Route::prefix('photographies')->name('photographies.')->group(function () {
        Route::get('/', App\Livewire\Photography::class)->name('index');
        Route::get('/{photography}/builder', App\Livewire\PhotographyBuilder::class)->name('builder');
    });

    Route::prefix('instagram')->name('instagram.')->group(function () {
        Route::get('/', App\Livewire\InstagramFeed::class)->name('index');
        Route::get('/connect', [InstagramController::class, 'redirect'])->name('connect');
        Route::post('/sync', [InstagramController::class, 'sync'])->name('sync');
        Route::delete('/disconnect', [InstagramController::class, 'disconnect'])->name('disconnect');
    });

    Route::get('/settings', App\Livewire\Setting::class)->name('settings.index');
});
