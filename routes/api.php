<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\BarangController;

/*
|--------------------------------------------------------------------------
| 🌍 API ROUTES — FIXED FULL CRUD for CoffeeShop ☕ (Final Stable)
|--------------------------------------------------------------------------
| Mendukung:
| ✅ GET, POST, PUT, DELETE
| ✅ Akses dari frontend (fetch/axios, Railway, Netlify, localhost)
| ✅ Akses dari form HTML (_method=PUT/_method=DELETE)
|-------------------------------------------------------------------------- 
*/

/* ============================
   ☕ ENDPOINT: KOPI
============================ */
Route::prefix('kopi')->group(function () {
    // ✅ Ambil semua data kopi
    Route::get('/', [BarangController::class, 'apiKopi'])->name('kopi.index');

    // ✅ Tambah kopi baru
    Route::post('/', [BarangController::class, 'storeKopi'])->name('kopi.store');

    // ✅ Update kopi (PUT atau POST + _method=PUT)
    Route::match(['put', 'post'], '/{id}', [BarangController::class, 'apiUpdateKopi'])
        ->name('kopi.update');

    // ✅ Hapus kopi (DELETE atau POST + _method=DELETE)
    Route::match(['delete', 'post'], '/{id}/delete', [BarangController::class, 'apiDeleteKopi'])
        ->name('kopi.delete');
});


/* ============================
   🧋 ENDPOINT: NON KOPI
============================ */
Route::prefix('nonkopi')->group(function () {
    // ✅ Ambil semua data nonkopi
    Route::get('/', [BarangController::class, 'apiNonKopi'])->name('nonkopi.index');

    // ✅ Tambah nonkopi baru
    Route::post('/', [BarangController::class, 'storeNonKopi'])->name('nonkopi.store');

    // ✅ Update nonkopi (PUT atau POST + _method=PUT)
    Route::match(['put', 'post'], '/{id}', [BarangController::class, 'apiUpdateNonKopi'])
        ->name('nonkopi.update');

    // ✅ Hapus nonkopi (DELETE atau POST + _method=DELETE)
    Route::match(['delete', 'post'], '/{id}/delete', [BarangController::class, 'apiDeleteNonKopi'])
        ->name('nonkopi.delete');
});


/* ============================
   🔐 LOGIN API
============================ */
Route::post('/login', function (Request $request) {
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        return response()->json([
            'status' => 'success',
            'user'   => $user,
        ]);
    }

    return response()->json([
        'status'  => 'error',
        'message' => 'Email atau password salah',
    ], 401);
})->withoutMiddleware(['auth:sanctum', 'auth:api']);
