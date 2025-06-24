<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KKController;
use App\Http\Controllers\PendudukController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/data-kk', [KKController::class, 'index'])->name('kk.index');
    Route::get('/data-kk/create', [KKController::class, 'create'])->name('kk.create');
    Route::get('/data-kk/{noKK}', [KKController::class, 'show'])->name('kk.show');
    Route::post('/data-kk', [KKController::class, 'store'])->name('kk.store');
    Route::get('/data-kk/{noKK}/edit', [KKController::class, 'edit'])->name('kk.edit');
    Route::put('/data-kk/{noKK}', [KKController::class, 'update'])->name('kk.update');
    Route::delete('/data-kk/{noKK}', [KKController::class, 'destroy'])->name('kk.destroy');

    Route::get('/data-penduduk', [PendudukController::class, 'index'])->name('penduduk.index');
    Route::get('/data-penduduk/create', [PendudukController::class, 'create'])->name('penduduk.create');
    Route::get('/data-penduduk/{nik}', [PendudukController::class, 'show'])->name('penduduk.show');
    Route::post('/data-penduduk', [PendudukController::class, 'store'])->name('penduduk.store');
    Route::get('/data-penduduk/{nik}/edit', [PendudukController::class, 'edit'])->name('penduduk.edit');
    Route::put('/data-penduduk/{nik}', [PendudukController::class, 'update'])->name('penduduk.update');
    Route::delete('/data-penduduk/{nik}', [PendudukController::class, 'destroy'])->name('penduduk.destroy');

    
    // Route::get('data-penduduk', function () {
    //     return Inertia::render('DataPenduduk');
    // })->name('data-penduduk');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('users', \App\Http\Controllers\UserController::class)->except(['show']);
});

