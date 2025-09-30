<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\BarangController;

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
