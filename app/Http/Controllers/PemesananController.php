<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    /**
     * Menyimpan data pemesanan baru ke dalam database.
     * Ini adalah method yang sudah diperbaiki secara menyeluruh.
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'pembayaran' => 'required|string|in:Cash,Transfer',
            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'bukti_pembayaran' => $request->pembayaran === 'Transfer' ? 'required|file|mimes:jpeg,png,jpg,pdf|max:2048' : 'nullable',
        ]);

        // 2. Memulai database transaction untuk memastikan semua data tersimpan dengan aman
        DB::beginTransaction();
        try {
            // 3. Hitung total harga di server agar aman
            $totalHarga = 0;
            foreach ($validated['items'] as $item) {
                $barang = Barang::find($item['barang_id']);
                $totalHarga += $barang->harga * $item['jumlah'];
            }

            // 4. Buat SATU catatan pesanan utama
            $pemesanan = Pemesanan::create([
                'user_id' => Auth::id(),
                'nama_pemesan' => $validated['nama_pemesan'],
                'nomor_telepon' => $validated['nomor_telepon'],
                'metode_pembayaran' => $validated['pembayaran'],
                'total_harga' => $totalHarga,
                'status' => 'pending',
            ]);

            // Simpan bukti pembayaran jika ada
            if ($request->pembayaran == 'Transfer' && $request->hasFile('bukti_pembayaran')) {
                $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
                $pemesanan->bukti_pembayaran = $path; // Pastikan ada kolom ini di database
                $pesanan->save();
            }

            // 5. Lampirkan detail item-item yang dipesan ke pesanan utama
            foreach ($validated['items'] as $item) {
                // Ini membutuhkan relasi 'barangs' di Model Pemesanan
                $pemesanan->barangs()->attach($item['barang_id'], ['jumlah' => $item['jumlah']]);
            }

            DB::commit(); // Konfirmasi dan simpan semua perubahan

            // 6. Arahkan pengguna ke halaman riwayat pesanannya dengan pesan sukses
            return redirect()->route('pesanan.index')->with('success', 'Pesanan Anda berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua proses jika terjadi error
            return back()->with('error', 'Gagal menyimpan pesanan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menampilkan daftar pesanan untuk USER yang sedang login.
     */
    public function index()
    {
        $pesanans = Pemesanan::where('user_id', auth()->id())
                                ->with('barangs') // Eager load relasi barangs
                                ->latest() // Urutkan dari yang terbaru
                                ->get();

        return view('pesanan.index', compact('pesanans'));
    }

    /**
     * Menampilkan SEMUA pesanan untuk ADMIN.
     */
    public function showAllPesanan()
    {
        $pesanans = Pemesanan::with('barangs')
                                ->latest()
                                ->get();

        return view('admin.pesanan.list', compact('pesanans'));
    }

    /**
     * Menyetujui pesanan oleh ADMIN.
     */
    public function approve($id)
    {
        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->status = 'approved';
        $pesanan->save();

        return redirect()->back()->with('success', 'Pesanan telah disetujui.');
    }

    /**
     * Menghapus pesanan oleh ADMIN.
     */
    public function destroy($id)
    {
        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('admin.pesanan.list')->with('success', 'Pesanan berhasil dihapus!');
    }
}
