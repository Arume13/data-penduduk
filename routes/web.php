<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('data-kk', function () {
        return Inertia::render('DataKK');
    })->name('data-kk');

    Route::get('data-penduduk', function () {
        return Inertia::render('DataPenduduk');
    })->name('data-penduduk');
});
