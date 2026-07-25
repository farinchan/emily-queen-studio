<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');
