<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Menyimpan data pemesanan ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'menus' => 'required|array',
            'menus.*.menu' => 'required|string|max:255',
            'menus.*.quantity' => 'required|integer|min:1',
            'phone' => 'nullable|string|max:255',
            'Harga' => 'required|integer|min:0',
            'Pembayaran' => 'required|in:Cash,Transfer',
            'bukti_pembayaran' => $request->Pembayaran === 'Transfer' ? 'required|file|mimes:jpeg,png,jpg,pdf|max:2048' : 'nullable',

        ]);

        // Menyimpan setiap item menu sebagai pesanan
        foreach ($request->menus as $menu) {
            // Membuat pesanan baru
            $pesanan = Pemesanan::create([
                'name' => $request->name,
                'menu' => $menu['menu'],
                'quantity' => $menu['quantity'],
                'phone' => $request->phone,
                'Harga' => $request->Harga,
                'Pembayaran' => $request->Pembayaran,
                'user_id' => auth()->id(),
            ]);

            // Jika pembayaran dengan Transfer, simpan bukti transfer
            if ($request->Pembayaran == 'Transfer' && $request->hasFile('bukti_pembayaran')) {
                // Menyimpan bukti transfer ke storage
                $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
                $pesanan->bukti_transfer = $path;
            }

            $pesanan->save();
        }

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil disimpan.');
    }

    /**
     * Menampilkan daftar pesanan.
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            // Jika admin, ambil semua pesanan
            $pesanans = Pemesanan::all();
        } else {
            // Jika bukan admin, ambil pesanan berdasarkan user yang sedang login
            $pesanans = Pemesanan::where('user_id', auth()->id())->get();
        }

        return view('lihat-pesanan', compact('pesanans')); // Mengirim data pesanan ke view
    }

    /**
     * Menghapus pesanan berdasarkan ID.
     */
    public function destroy($id)
    {
        $pesanan = Pemesanan::findOrFail($id); // Cari pesanan berdasarkan ID
        $pesanan->delete(); // Hapus pesanan

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus!');
    }

    /**
     * Memperbarui data pesanan.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'Pembayaran' => 'required|in:Cash,Transfer',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Menemukan pesanan yang akan diperbarui
        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->name = $request->name;
        $pesanan->phone = $request->phone;
        $pesanan->pembayaran = $request->Pembayaran;

        // Jika pembayaran dengan Transfer dan ada bukti pembayaran
        if ($request->Pembayaran == 'Transfer' && $request->hasFile('bukti_pembayaran')) {
            // Menyimpan bukti transfer
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $pesanan->bukti_transfer = $path;
        }

        // Simpan data lainnya sesuai dengan form
        $pesanan->save();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }
    public function aprove($id)
{
    $pesanan = Pemesanan::findOrFail($id);
    $pesanan->status = 'approved'; // Pastikan ada kolom 'status' di tabel.
    $pesanan->save();

    return redirect()->back()->with('success', 'Pesanan telah disetujui.');
}

}
