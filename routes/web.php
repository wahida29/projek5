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
Route::get('/kopi', [BarangController::class, 'showKopi'])->name('kopi');
Route::get('/nonkopi', [BarangController::class, 'showNonKopi'])->name('nonkopi');

// Pemesanan routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/lihat-pesanan', [PemesananController::class, 'index'])->name('pesanan.index');
    Route::post('/kopi/store', [PemesananController::class, 'store'])->name('pesan.kopi2.store');
    Route::delete('/pesanan/{id}', [PemesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/{id}/approve', [PemesananController::class, 'approve'])->name('pesanan.approve');
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
    Route::post('/kopi', [PemesananController::class, 'store'])->name('pesan.kopi.store');
    Route::post('/nonkopi', [PemesananController::class, 'store'])->name('pesan.nonkopi.store');
    Route::delete('/pesanan/{id}', [PemesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/{id}/aprove', [PemesananController::class, 'approve'])->name('pesanan.aprove');


});

// Authentication routes
require __DIR__.'/auth.php';

Route::get('/crud', function () {
    return view('crud.index');
});
use Illuminate\Support\Facades\Http;

Route::get('/proxy/{kelompok}/{endpoint?}', function ($kelompok, $endpoint = '') {
    $apis = [
        'k3' => 'https://gadgethouse-production.up.railway.app/api/',
        'k4' => 'https://projekkelompok4-production-3d9b.up.railway.app/api/',
        'k5' => 'https://projek5-production.up.railway.app/api/',
        'promo' => 'https://sobatpromo-api-production.up.railway.app/api.php?action=list',
        'justbuy' => 'https://justbuy-production.up.railway.app/api/',
        'reservasi' => 'https://reservasi-production.up.railway.app/api/',
    ];

    $base = $apis[$kelompok] ?? null;
    if (!$base) abort(404);

    try {
        $response = Http::get($base . $endpoint);
        return $response->json();
    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal menghubungi API ' . $kelompok], 500);
    }
});

