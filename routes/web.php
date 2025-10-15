<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| ROUTE UTAMA (TIDAK DIUBAH)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/kontak', fn() => view('kontak'))->name('kontak');
    Route::get('/menu', fn() => view('menu'))->name('menu');
});

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
    Route::post('/kopi', [PemesananController::class, 'store'])->name('pesan.kopi.store');
    Route::post('/nonkopi', [PemesananController::class, 'store'])->name('pesan.nonkopi.store');
    Route::post('/pesanan/{id}/aprove', [PemesananController::class, 'approve'])->name('pesanan.aprove');
});

// Profil management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__ . '/auth.php';

// CRUD dashboard utama
Route::get('/crud', fn() => view('crud.index'))->name('crud.index');


/*
|--------------------------------------------------------------------------
| 🔗 PROXY API 7 KELOMPOK (TAMBAHAN UNTUK FULL CRUD)
|--------------------------------------------------------------------------
| Bagian ini ditambahkan tanpa menghapus apa pun di atas.
| Gunanya supaya index.blade.php bisa akses API luar (anti-CORS).
| Mendukung GET, POST, PUT, PATCH, DELETE.
|--------------------------------------------------------------------------
*/

Route::match(['GET', 'POST', 'PUT', 'PATCH', 'DELETE'], '/proxy/{kelompok}/{endpoint?}', function ($kelompok, $endpoint = null) {
    $apis = [
        'k3'        => 'https://gadgethouse-production.up.railway.app/api/',
        'k4'        => 'https://projekkelompok4-production-3d9b.up.railway.app/api/',
        'k5'        => 'https://projek5-production.up.railway.app/api/',
        'promo'     => 'https://sobatpromo-api-production.up.railway.app/api.php',
        'justbuy'   => 'https://justbuy-production.up.railway.app/api/',
        'reservasi' => 'https://reservasi-production.up.railway.app/api/',
    ];

    // Validasi kelompok
    if (!isset($apis[$kelompok])) {
        return response()->json(['error' => "Kelompok '$kelompok' tidak dikenal"], 404);
    }

    // Rakit URL akhir
    $base = rtrim($apis[$kelompok], '/');
    $url = $base . ($endpoint ? '/' . ltrim($endpoint, '/') : '');

    // Method dan body request
    $method = strtoupper(request()->method());
    $options = [];

    if (!empty(request()->all())) {
        $options['json'] = request()->all();
    }

    try {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->send($method, $url, $options);

        $contentType = $response->header('Content-Type', 'application/json');

        // Kirim balik hasil response
        if (str_contains($contentType, 'application/json')) {
            return response()->json($response->json(), $response->status());
        } else {
            return response($response->body(), $response->status())
                ->header('Content-Type', $contentType);
        }
    } catch (\Throwable $e) {
        return response()->json([
            'error' => 'Proxy gagal: ' . $e->getMessage(),
            'url' => $url,
            'method' => $method,
            'data' => request()->all(),
        ], 500);
    }
});
