<x-app-layout>
    <div class="container px-4 py-8 mx-auto">
        <h2 class="mb-10 text-3xl font-extrabold tracking-wide text-center text-orange-500 drop-shadow-md">
            ✨ Daftar Pesanan ✨
        </h2>

        @if (session('success'))
            <div class="p-3 mb-4 text-green-600 bg-green-100 border border-green-300 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="w-full text-sm bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="text-white bg-gradient-to-r from-orange-400 to-orange-500">
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Menu</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Nomor Telepon</th>
                        <th class="px-4 py-3">Total Harga</th>
                        <th class="px-4 py-3">Customer Total</th>
                        <th class="px-4 py-3">Tanggal Pesan</th>
                        <th class="px-4 py-3">Metode Pembayaran</th>
                        <th class="px-4 py-3">Bukti Transfer</th>
                        <th class="px-4 py-3">Status</th>

                        @if (Auth::check() && Auth::user()->role === 'admin')
                            <th class="px-4 py-3">Approve</th>
                            <th class="px-4 py-3">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp

                    @forelse ($pesanans->groupBy('name') as $customerName => $orders)
                        @php
                            $customerTotal = $orders->sum('Harga');
                            $grandTotal += $customerTotal;
                        @endphp

                        <tr class="text-center bg-gray-100 border-b">
                            <td class="px-4 py-3 font-bold text-gray-700 uppercase" colspan="12">
                                👤 {{ $customerName }}
                            </td>
                        </tr>

                        @foreach ($orders as $order)
                            <tr class="text-center transition duration-200 border-b hover:bg-orange-50">
                                <td></td>
                                <td class="px-4 py-2">{{ $order->menu }}</td>
                                <td class="px-4 py-2">{{ $order->quantity }}</td>
                                <td class="px-4 py-2">{{ $order->phone ?? '-' }}</td>
                                <td class="px-4 py-2 font-semibold text-gray-700">
                                    Rp{{ number_format($order->Harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2"></td>
                                <td class="px-4 py-2">{{ $order->created_at->format('d-m-Y') }}</td>
                                <td class="px-4 py-2 italic text-gray-600">{{ $order->Pembayaran ?? 'Belum Ditentukan' }}</td>
                                <td class="px-4 py-2">
                                    @if ($order->bukti_transfer)
                                        <button
                                            onclick="showModal('{{ asset("storage/{$order->bukti_transfer}") }}')"
                                            class="text-blue-600 transition hover:text-blue-800 hover:underline">
                                            📷 Lihat Bukti
                                        </button>
                                    @else
                                        <span class="text-gray-400">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if ($order->status === 'approved')
                                        <span class="px-2 py-1 text-xs font-bold text-white bg-green-500 rounded shadow">
                                            ✅ Disetujui
                                        </span>
                                    @elseif ($order->status === 'pending')
                                        <span class="px-2 py-1 text-xs font-bold text-white bg-yellow-500 rounded shadow">
                                            ⏳ Menunggu
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded shadow">
                                            ❌ Ditolak
                                        </span>
                                    @endif
                                </td>

                                @if (Auth::check() && Auth::user()->role === 'admin')
                                    <td class="px-4 py-2">
                                        @if ($order->status !== 'approved')
                                            <form action="{{ route('pesanan.approve', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui pesanan ini?');">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 text-sm font-semibold text-white transition bg-green-500 rounded hover:bg-green-600">
                                                    Approval
                                                </button>
                                            </form>
                                        @else
                                            <span class="px-2 py-1 text-xs font-bold text-white bg-green-500 rounded shadow">Sudah</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('pesanan.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 text-sm font-semibold text-white transition bg-red-500 rounded hover:bg-red-600">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                        <tr class="text-center bg-orange-100 border-b">
                            <td colspan="4" class="px-4 py-2 font-bold text-right">Total:</td>
                            <td colspan="8" class="px-4 py-2 font-bold text-orange-600">
                                Rp{{ number_format($customerTotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="px-4 py-4 text-center text-gray-500">📭 Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-80">
        <div class="relative p-4 bg-white rounded-lg shadow-xl">
            <button
                onclick="closeModal()"
                class="absolute px-3 py-1 text-white transition bg-red-600 rounded-full top-2 right-2 hover:bg-red-700"
            >
                ✖
            </button>
            <img id="modalImage" src="" alt="Bukti Transfer" class="max-w-full max-h-[80vh] rounded-lg shadow-md">
        </div>
    </div>

    <footer class="py-6 text-white bg-gradient-to-r from-gray-900 to-gray-800">
        <div class="container mx-auto text-center">
            <p class="text-lg font-semibold">&copy; 2025 <span class="text-orange-400">KRUSIT</span>. All rights reserved.</p>
            <div class="flex justify-center mt-4 space-x-6">
                <a href="#" class="transition hover:text-orange-400">🌐 Facebook</a>
                <a href="#" class="transition hover:text-orange-400">📸 Instagram</a>
                <a href="#" class="transition hover:text-orange-400">🐦 Twitter</a>
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
