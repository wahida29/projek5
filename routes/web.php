<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| ROUTE UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('welcome'));

Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/kontak', fn() => view('kontak'))->name('kontak');
    Route::get('/menu', fn() => view('menu'))->name('menu');
});

// Barang (menu kopi / nonkopi)
Route::middleware('auth')->group(function () {
    Route::resource('barang', BarangController::class);
    Route::get('/kopi', [BarangController::class, 'showKopi'])->name('kopi');
    Route::get('/nonkopi', [BarangController::class, 'showNonKopi'])->name('nonkopi');
});

// Pemesanan
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/lihat-pesanan', [PemesananController::class, 'index'])->name('pesanan.index');
    Route::post('/kopi/store', [PemesananController::class, 'store'])->name('pesan.kopi2.store');
    Route::delete('/pesanan/{id}', [PemesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/{id}/approve', [PemesananController::class, 'approve'])->name('pesanan.approve');
    Route::post('/kopi', [PemesananController::class, 'store'])->name('pesan.kopi.store');
    Route::post('/nonkopi', [PemesananController::class, 'store'])->name('pesan.nonkopi.store');
});

// Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__ . '/auth.php';

// CRUD Dashboard utama
Route::get('/crud', fn() => view('crud.index'))->name('crud.index');

/*
|--------------------------------------------------------------------------
| 🔗 PROXY 7 KELOMPOK (ANTI-CORS UNTUK DASHBOARD)
|--------------------------------------------------------------------------
| Mendukung GET, POST, PUT, PATCH, DELETE
| Supaya semua API (K3–K7) bisa diakses lewat /proxy/...
|-------------------------------------------------------------------------- 
*/

Route::match(['GET', 'POST', 'PUT', 'PATCH', 'DELETE'], '/proxy/{kelompok}/{endpoint?}', function ($kelompok, $endpoint = '') {
    $apis = [
        'k3'        => 'https://gadgethouse-production.up.railway.app/api/',
        'k4'        => 'https://projekkelompok4-production-3d9b.up.railway.app/api/',
        'k5'        => 'https://projek5-production.up.railway.app/api/',
        'promo'     => 'https://sobatpromo-api-production.up.railway.app/api.php',
        'justbuy'   => 'https://justbuy-production.up.railway.app/api/',
        'reservasi' => 'https://reservasi-production.up.railway.app/api/',
    ];

    // Pastikan kelompok valid
    if (!array_key_exists($kelompok, $apis)) {
        return response()->json(['error' => "Kelompok '$kelompok' tidak dikenal"], 404);
    }

    // Bangun URL target
    $base = rtrim($apis[$kelompok], '/');
    $url = str_starts_with($endpoint, '?')
        ? $base . $endpoint
        : $base . '/' . ltrim($endpoint, '/');

    try {
        $method = request()->method();
        $options = [];

        // Kirim JSON body jika ada
        if (!empty(request()->all())) {
            $options['json'] = request()->all();
        }

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->send($method, $url, $options);

        return response($response->body(), $response->status())
            ->header('Content-Type', $response->header('Content-Type') ?? 'application/json');

    } catch (\Throwable $e) {
        return response()->json([
            'error' => 'Proxy gagal: ' . $e->getMessage(),
            'url' => $url,
            'method' => request()->method(),
        ], 500);
    }
});
