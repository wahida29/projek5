<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\BarangController;

// ================================================================
// ORIGINAL ROUTES (TIDAK DIHAPUS) 💎
// ================================================================

Route::put('/kopi/{id}', [BarangController::class, 'apiUpdateKopi']);
Route::delete('/kopi/{id}', [BarangController::class, 'apiDeleteKopi']);
Route::put('/nonkopi/{id}', [BarangController::class, 'apiUpdateNonKopi']);
Route::delete('/nonkopi/{id}', [BarangController::class, 'apiDeleteNonKopi']);
Route::post('/kopi', [BarangController::class, 'storeKopi']);
Route::post('/nonkopi', [BarangController::class, 'storeNonKopi']);
Route::get('/kopi', [BarangController::class, 'apiKopi']);
Route::get('/nonkopi', [BarangController::class, 'apiNonKopi']);

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
})->withoutMiddleware(['auth:sanctum', 'auth:api']); // 🚀 penting


// ================================================================
// ✅ TAMBAHAN PERBAIKAN UNTUK FORM HTML (AGAR EDIT/DELETE BERFUNGSI)
// ================================================================
//
// Keterangan:
// HTML `index.blade.php` kamu mengirim request pakai FormData (method POST)
// dengan field `_method=PUT` atau `_method=DELETE`.
// Laravel default hanya menerima PUT/DELETE murni dari Postman,
// jadi kita tambahkan versi `Route::match(['put','post'],...)`
// supaya keduanya diterima tanpa mengubah kode lama.
//
// ================================================================

// --- KOPI ---
Route::match(['put', 'post'], '/kopi/{id}', [BarangController::class, 'apiUpdateKopi'])
    ->name('kopi.update.html');
Route::match(['delete', 'post'], '/kopi/{id}', [BarangController::class, 'apiDeleteKopi'])
    ->name('kopi.delete.html');

// --- NON KOPI ---
Route::match(['put', 'post'], '/nonkopi/{id}', [BarangController::class, 'apiUpdateNonKopi'])
    ->name('nonkopi.update.html');
Route::match(['delete', 'post'], '/nonkopi/{id}', [BarangController::class, 'apiDeleteNonKopi'])
    ->name('nonkopi.delete.html');

// ================================================================
// Penjelasan:
// Sekarang Laravel akan menerima:
// - PUT /kopi/{id}  ✅ (Postman)
// - POST /kopi/{id} + _method=PUT ✅ (Form HTML)
// - DELETE /kopi/{id} ✅
// - POST /kopi/{id} + _method=DELETE ✅
//
// Jadi tombol Edit dan Delete di dashboard index.blade.php
// bisa berfungsi di Railway maupun localhost tanpa error 405.
// ================================================================
