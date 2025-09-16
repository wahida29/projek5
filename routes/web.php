<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rute Publik
|--------------------------------------------------------------------------
| Dapat diakses oleh siapa saja, bahkan yang belum login.
*/
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Rute User Terautentikasi
|--------------------------------------------------------------------------
| Membutuhkan login. Dapat diakses oleh 'user' maupun 'admin'.
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Halaman Dasbor Utama (Pengarah Otomatis)
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard'); // Arahkan ke dasbor admin
        }
        return view('dashboard'); // Tampilkan dasbor user biasa
    })->name('dashboard');

    // Halaman Menu & Kontak
    Route::get('/menu', function () { return view('menu'); })->name('menu');
    Route::get('/kontak', function () { return view('kontak'); })->name('kontak');

    // Halaman untuk melihat makanan & minuman
    Route::get('/makanan', [BarangController::class, 'showMakanan'])->name('makanan');
    Route::get('/minuman', [BarangController::class, 'showMinuman'])->name('minuman');

    // Proses membuat pesanan baru
    Route::post('/pesan/store', [PemesananController::class, 'store'])->name('pesanan.store');

    // Halaman untuk user melihat riwayat pesanannya sendiri
    Route::get('/pesanan-saya', [PemesananController::class, 'index'])->name('pesanan.index');

    // Rute untuk manajemen profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Rute Khusus Admin 🛡️
|--------------------------------------------------------------------------
| HANYA dapat diakses oleh pengguna dengan peran 'admin'.
| Dilindungi oleh middleware 'auth' dan 'admin'.
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dasbor Khusus Admin
    Route::get('/dashboard', function() {
        // Anda bisa menambahkan logika untuk mengambil data khusus admin di sini
        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD (Create, Read, Update, Delete) untuk Barang/Menu
    Route::resource('barang', BarangController::class);

    // Manajemen Pesanan oleh Admin (Melihat semua pesanan, approve, delete)
    Route::get('/pesanan', [PemesananController::class, 'showAllPesanan'])->name('pesanan.list');
    Route::post('/pesanan/{id}/approve', [PemesananController::class, 'approve'])->name('pesanan.approve');
    Route::delete('/pesanan/{id}', [PemesananController::class, 'destroy'])->name('pesanan.destroy');

});


// Rute Autentikasi (Login, Register, dll.)
require __DIR__.'/auth.php';
