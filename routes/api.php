<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\BarangController;

Route::put('/kopi/{id}', [BarangController::class, 'apiUpdateMakanan']);
Route::delete('/kopi/{id}', [BarangController::class, 'apiDeleteMakanan']);
Route::put('/minuman/{id}', [BarangController::class, 'apiUpdateMinuman']);
Route::delete('/minuman/{id}', [BarangController::class, 'apiDeleteMinuman']);
Route::post('/kopi', [BarangController::class, 'storeMakanan']);
Route::post('/minuman', [BarangController::class, 'storeMinuman']);
Route::get('/kopi', [BarangController::class, 'apiMakanan']);
Route::get('/minuman', [BarangController::class, 'apiMinuman']);
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
