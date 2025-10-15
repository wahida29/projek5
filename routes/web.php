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

// Barang
Route::resource('barang', BarangController::class)->middleware('auth');
Route::get('/kopi', [BarangController::class, 'showKopi'])->name('kopi');
Route::get('/nonkopi', [BarangController::class, 'showNonKopi'])->name('nonkopi');

// Pemesanan
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/lihat-pesanan', [PemesananController::class, 'index'])->name('pesanan.index');
    Route::post('/kopi/store', [PemesananController::class, 'store'])->name('pesan.kopi2.store');
    Route::delete('/pesanan/{id}', [PemesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/{id}/approve', [PemesananController::class, 'approve'])->name('pesanan.approve');
    Route::post('/kopi', [PemesananController::class, 'store'])->name('pesan.kopi.store');
    Route::post('/nonkopi', [PemesananController::class, 'store'])->name('pesan.nonkopi.store');
    Route::post('/pesanan/{id}/aprove', [PemesananController::class, 'approve'])->name('pesanan.aprove');
});

// Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autentikasi
require __DIR__ . '/auth.php';

// CRUD dashboard utama
Route::get('/crud', fn() => view('crud.index'))->name('crud.index');


/*
|--------------------------------------------------------------------------
| 🔗 PROXY API 7 KELOMPOK (ANTI CORS UNTUK RAILWAY)
|--------------------------------------------------------------------------
|
| Route ini digunakan untuk meneruskan request frontend (index.blade.php)
| ke API masing-masing kelompok agar bisa full CRUD (GET, POST, PUT, DELETE).
| Tidak bentrok dengan route lain.
|
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

    if (!isset($apis[$kelompok])) {
        return response()->json(['error' => 'Kelompok tidak dikenal'], 404);
    }

    $base = rtrim($apis[$kelompok], '/');
    $url = str_starts_with((string)$endpoint, '?')
        ? $base . $endpoint
        : $base . '/' . ltrim((string)$endpoint, '/');

    $method = request()->method();
    $options = [];

    if (!empty(request()->all())) {
        $options['json'] = request()->all();
    }

    try {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->send($method, $url, $options);

        $type = $response->header('Content-Type');
        if ($type && str_contains($type, 'application/json')) {
            return response()->json($response->json(), $response->status());
        }
        return response($response->body(), $response->status())
            ->header('Content-Type', $type ?? 'text/plain');
    } catch (\Throwable $e) {
        return response()->json([
            'error' => 'Proxy gagal: ' . $e->getMessage(),
        ], 502);
    }
});
