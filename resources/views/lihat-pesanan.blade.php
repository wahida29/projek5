<x-app-layout>
    <div class="container px-4 py-8 mx-auto">
        <h2 class="mb-10 text-3xl font-bold text-center text-orange-400">Daftar Pesanan</h2>

        @if (session('success'))
            <div class="mb-4 text-green-500">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full bg-white rounded-lg shadow-lg">
            <thead>
                <tr class="text-white bg-orange-400">
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Menu</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Nomor Telepon</th>
                    <th class="px-4 py-2">Total Harga</th>
                    <th class="px-4 py-2">Customer Total</th>
                    <th class="px-4 py-2">Tanggal Pesan</th>
                    <th class="px-4 py-2">Metode Pembayaran</th>
                    <th class="px-4 py-2">Bukti Transfer</th>
                    <th class="px-4 py-2">Status</th>
                    @if (Auth::check() && Auth::user()->role === 'admin')
                        <th class="px-4 py-2">Aprove</th>
                        <th class="px-4 py-2">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php
                    $grandTotal = 0;
                @endphp

                @forelse ($pesanans->groupBy('name') as $customerName => $orders)
                    @php
                        $customerTotal = $orders->sum('Harga');
                        $grandTotal += $customerTotal;
                    @endphp

                    <tr class="text-center bg-gray-100 border-b">
                        <td class="px-4 py-2 font-bold" colspan="12">{{ $customerName }}</td>
                    </tr>

                    @foreach ($orders as $order)
                        <tr class="text-center border-b">
                            <td></td>
                            <td class="px-4 py-2">{{ $order->menu }}</td>
                            <td class="px-4 py-2">{{ $order->quantity }}</td>
                            <td class="px-4 py-2">{{ $order->phone ?? '-' }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($order->Harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2">{{ $order->created_at->format('d-m-Y') }}</td>
                            <td class="px-4 py-2">{{ $order->Pembayaran ?? 'Belum Ditentukan' }}</td>
                            <td class="px-4 py-2">
                                @if ($order->bukti_transfer)
                                    <button
                                        onclick="showModal('{{ asset('storage/' . $order->bukti_transfer) }}')"
                                        class="text-blue-500 hover:underline"
                                    >
                                        Lihat Bukti
                                    </button>
                                @else
                                    <span class="text-gray-500">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if ($order->status === 'approved')
                                    <span class="px-2 py-1 text-white bg-green-500 rounded">Disetujui</span>
                                @elseif ($order->status === 'pending')
                                    <span class="px-2 py-1 text-white bg-yellow-500 rounded">Menunggu</span>
                                @else
                                    <span class="px-2 py-1 text-white bg-red-500 rounded">Ditolak</span>
                                @endif
                            </td>
                            @if (Auth::check() && Auth::user()->role === 'admin')
                                <td class="px-4 py-2">
                                    @if ($order->status !== 'approved')
                                        <form action="{{ route('pesanan.approve', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui pesanan ini?');">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                                                Aproval
                                            </button>
                                        </form>
                                    @else
                                        <span class="px-2 py-1 text-white bg-green-500 rounded">Disetujui</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('pesanan.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                    <tr class="text-center bg-orange-100 border-b">
                        <td colspan="4" class="px-4 py-2 font-bold text-right">Total:</td>
                        <td colspan="8" class="px-4 py-2 font-bold text-orange-500">Rp{{ number_format($customerTotal, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="px-4 py-2 text-center">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal untuk Gambar Bukti Transfer -->
    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-75">
        <div class="relative">
            <button
                onclick="closeModal()"
                class="absolute top-0 right-0 px-4 py-2 text-white bg-red-600 rounded-full"
            >
                X
            </button>
            <img id="modalImage" src="" alt="Bukti Transfer" class="max-w-full max-h-screen">
        </div>
    </div>

    <footer class="py-6 text-white bg-gray-900">
        <div class="container mx-auto text-center">
            <p class="text-lg font-semibold">&copy; 2024 KRUSIT. All rights reserved.</p>
            <div class="flex justify-center mt-4 space-x-6">
                <a href="#" class="text-white transition hover:text-orange-400">Facebook</a>
                <a href="#" class="text-white transition hover:text-orange-400">Instagram</a>
                <a href="#" class="text-white transition hover:text-orange-400">Twitter</a>
            </div>
        </div>
    </footer>

    <script>
        function showModal(imageUrl) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');

            modalImage.src = imageUrl;
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
        }
    </script>
</x-app-layout>
