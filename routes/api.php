<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\BarangController;

/*
|--------------------------------------------------------------------------
| API ROUTES — Final Versi Fix CRUD CoffeeShop ☕
|--------------------------------------------------------------------------
| Semua route ini mendukung:
| - Akses API (GET/POST/PUT/DELETE)
| - Akses dari Form HTML (pakai _method PUT/DELETE)
| - Akses langsung dari frontend (CORS & Railway friendly)
|--------------------------------------------------------------------------
*/

// ============================
// ☕ KOPI ENDPOINTS
// ============================

// ✅ Ambil semua data kopi
Route::get('/kopi', [BarangController::class, 'apiKopi'])->name('kopi.index');

// ✅ Tambah kopi baru
Route::post('/kopi', [BarangController::class, 'storeKopi'])->name('kopi.store');

// ✅ Update kopi — bisa PUT atau POST + _method=PUT
Route::match(['put', 'post'], '/kopi/{id}', [BarangController::class, 'apiUpdateKopi'])->name('kopi.update');

// ✅ Hapus kopi — bisa DELETE atau POST + _method=DELETE
Route::match(['delete', 'post'], '/kopi/{id}', [BarangController::class, 'apiDeleteKopi'])->name('kopi.delete');


// ============================
// 🧋 NON KOPI ENDPOINTS
// ============================

// ✅ Ambil semua data nonkopi
Route::get('/nonkopi', [BarangController::class, 'apiNonKopi'])->name('nonkopi.index');

// ✅ Tambah nonkopi baru
Route::post('/nonkopi', [BarangController::class, 'storeNonKopi'])->name('nonkopi.store');

// ✅ Update nonkopi — bisa PUT atau POST + _method=PUT
Route::match(['put', 'post'], '/nonkopi/{id}', [BarangController::class, 'apiUpdateNonKopi'])->name('nonkopi.update');

// ✅ Hapus nonkopi — bisa DELETE atau POST + _method=DELETE
Route::match(['delete', 'post'], '/nonkopi/{id}', [BarangController::class, 'apiDeleteNonKopi'])->name('nonkopi.delete');


// ================================================================
// 🔐 LOGIN API
// ================================================================
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
