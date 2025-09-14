<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Additional views
Route::get('/kontak', function () {
    return view('kontak');
})->middleware(['auth', 'verified'])->name('kontak');

Route::get('/menu', function () {
    return view('menu');
})->middleware(['auth', 'verified'])->name('menu');

// Barang routes
Route::resource('barang', BarangController::class)->middleware('auth');
Route::get('/makanan', [BarangController::class, 'showMakanan'])->name('makanan');
Route::get('/minuman', [BarangController::class, 'showMinuman'])->name('minuman');

// Pemesanan routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/lihat-pesanan', [PemesananController::class, 'index'])->name('pesanan.index');
    Route::post('/makanan/store', [PemesananController::class, 'store'])->name('pesan.store');
    Route::delete('/pesanan/{id}', [PemesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/{id}/approve', [PemesananController::class, 'aprove'])->name('pesanan.approve');
});

// Order routes

// Profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/lihat-pesanan', [PemesananController::class, 'index'])->name('pesanan.index');
    Route::post('/makanan', [PemesananController::class, 'store'])->name('pesan.store');
    Route::post('/minuman', [PemesananController::class, 'store'])->name('pesan.store');
    Route::delete('/pesanan/{id}', [PemesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/{id}/aprove', [PemesananController::class, 'aprove'])->name('pesanan.aprove');


});

// Authentication routes
require __DIR__.'/auth.php';
