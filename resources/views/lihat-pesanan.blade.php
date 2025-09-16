<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="mb-8 text-3xl font-bold text-center text-gray-800">Daftar Pesanan</h2>

            @if (session('success'))
                <div class="mb-4 text-white bg-green-500 rounded-lg">
                    <p class="p-4">{{ session('success') }}</p>
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Nama</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Menu</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Jumlah</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Nomor Telepon</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Total Harga</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Tanggal Pesan</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Pembayaran</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Status</th>
                                @if (Auth::user()->isAdmin())
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-white uppercase" colspan="2">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($pesanans->groupBy('name') as $customerName => $orders)
                                <tr class="bg-gray-50">
                                    <td class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap" colspan="{{ Auth::user()->isAdmin() ? 10 : 8 }}">
                                        {{ $customerName }}
                                    </td>
                                </tr>

                                @foreach ($orders as $order)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap"></td> <td class="px-6 py-4 whitespace-nowrap">{{ $order->menu }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->phone ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp{{ number_format($order->Harga, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $order->Pembayaran ?? 'N/A' }}
                                            @if ($order->bukti_transfer)
                                                <button onclick="showModal('{{ asset('storage/' . $order->bukti_transfer) }}')" class="ml-2 text-xs text-blue-500 hover:underline">(Lihat Bukti)</button>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($order->status === 'approved')
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Disetujui</span>
                                            @elseif ($order->status === 'pending')
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">Menunggu</span>
                                            @else
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Ditolak</span>
                                            @endif
                                        </td>

                                        @if (Auth::user()->isAdmin())
                                            <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                                @if ($order->status !== 'approved')
                                                    <form action="{{ route('admin.pesanan.approve', $order->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menyetujui pesanan ini?');">
                                                        @csrf
                                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">Approve</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                                <form action="{{ route('admin.pesanan.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus pesanan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td class="px-6 py-4 text-center text-gray-500 whitespace-nowrap" colspan="{{ Auth::user()->isAdmin() ? 10 : 8 }}">
                                        Belum ada pesanan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-75">
        <div class="relative p-4 bg-white rounded-lg">
            <button onclick="closeModal()" class="absolute flex items-center justify-center w-8 h-8 text-white bg-red-600 rounded-full -top-3 -right-3 hover:bg-red-700">
                &times;
            </button>
            <img id="modalImage" src="" alt="Bukti Transfer" class="max-w-screen-md max-h-screen">
        </div>
    </div>

    <script>
        function showModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
