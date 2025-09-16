<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Barang; // Import model Barang
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    /**
     * Menyimpan data pemesanan baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Langkah 1: Validasi Input dari Form
        // Pastikan 'name' di form Anda sesuai dengan aturan validasi ini.
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'pembayaran' => 'required|string|in:Cash,Transfer',
            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'bukti_pembayaran' => $request->pembayaran === 'Transfer' ? 'required|file|mimes:jpeg,png,jpg,pdf|max:2048' : 'nullable',
        ]);

        // Memulai database transaction untuk keamanan data
        DB::beginTransaction();
        try {
            // Langkah 2: Hitung Total Harga di Back-End (lebih aman)
            $totalHarga = 0;
            foreach ($validated['items'] as $item) {
                $barang = Barang::find($item['barang_id']);
                $totalHarga += $barang->harga * $item['jumlah'];
            }

            // Langkah 3: Simpan SATU Data Pesanan Utama
            $pemesanan = Pemesanan::create([
                'user_id' => Auth::id(),
                'nama_pemesan' => $validated['nama_pemesan'],
                'nomor_telepon' => $validated['nomor_telepon'],
                'metode_pembayaran' => $validated['pembayaran'],
                'total_harga' => $totalHarga,
                'status' => 'pending',
            ]);

            // Simpan bukti transfer jika ada
            if ($request->pembayaran == 'Transfer' && $request->hasFile('bukti_pembayaran')) {
                $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
                $pemesanan->bukti_pembayaran = $path;
                $pemesanan->save();
            }

            // Langkah 4: Simpan Detail Item Pesanan ke tabel pivot
            // Ini mengasumsikan Anda punya relasi Many-to-Many antara Pemesanan dan Barang
            foreach ($validated['items'] as $item) {
                $pemesanan->barangs()->attach($item['barang_id'], ['jumlah' => $item['jumlah']]);
            }

            DB::commit(); // Konfirmasi semua proses simpan jika berhasil

            // Langkah 5: Redirect ke halaman 'Lihat Pesanan' dengan pesan sukses
            return redirect()->route('pesanan.index')->with('success', 'Pesanan Anda berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua proses simpan jika ada error
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan daftar pesanan.
     */
    public function index()
    {
        // Menggunakan eager loading ('barangs') untuk efisiensi query
        if (auth()->user()->isAdmin()) {
            $pesanans = Pemesanan::with('barangs')->latest()->get();
        } else {
            $pesanans = Pemesanan::where('user_id', auth()->id())->with('barangs')->latest()->get();
        }

        return view('pesanan.index', compact('pesanans')); // Pastikan nama view benar
    }

    /**
     * Menghapus pesanan berdasarkan ID.
     */
    public function destroy($id)
    {
        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('admin.pesanan.list')->with('success', 'Pesanan berhasil dihapus!');
    }

    /**
     * Menyetujui pesanan oleh admin.
     */
    public function approve($id)
    {
        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->status = 'approved';
        $pesanan->save();

        return redirect()->back()->with('success', 'Pesanan telah disetujui.');
    }
}
