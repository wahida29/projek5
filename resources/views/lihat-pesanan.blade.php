<table class="w-full text-sm text-left bg-white border border-gray-200 rounded-lg shadow-lg">
    <thead class="text-white bg-orange-400">
        <tr>
            <th class="px-4 py-3 text-center">Nama</th>
            <th class="px-4 py-3 text-center">Menu</th>
            <th class="px-4 py-3 text-center">Jumlah</th>
            <th class="px-4 py-3 text-center">Nomor Telepon</th>
            <th class="px-4 py-3 text-center">Total Harga</th>
            <th class="px-4 py-3 text-center">Customer Total</th>
            <th class="px-4 py-3 text-center">Tanggal Pesan</th>
            <th class="px-4 py-3 text-center">Metode Pembayaran</th>
            <th class="px-4 py-3 text-center">Bukti Transfer</th>
            <th class="px-4 py-3 text-center">Status</th>
            @if (Auth::check() && Auth::user()->role === 'admin')
                <th class="px-4 py-3 text-center">Approve</th>
                <th class="px-4 py-3 text-center">Aksi</th>
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
                <td class="px-4 py-2 font-bold text-gray-700 uppercase" colspan="12">
                    {{ $customerName }}
                </td>
            </tr>

            @foreach ($orders as $order)
                <tr class="text-center border-b hover:bg-gray-50">
                    <td class="px-4 py-2"></td>
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
                                class="text-blue-500 hover:underline">
                                Lihat Bukti
                            </button>
                        @else
                            <span class="text-gray-400">Tidak ada</span>
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
                                    <button type="submit" class="px-3 py-1 font-semibold text-white bg-green-500 rounded hover:bg-green-600">
                                        Approve
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
                                <button type="submit" class="px-3 py-1 font-semibold text-white bg-red-500 rounded hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach

            <tr class="font-bold text-center bg-orange-100 border-b">
                <td colspan="4" class="px-4 py-2 text-right">Total:</td>
                <td colspan="8" class="px-4 py-2 text-orange-600">Rp{{ number_format($customerTotal, 0, ',', '.') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="12" class="px-4 py-4 text-center text-gray-500">Belum ada pesanan.</td>
            </tr>
        @endforelse
    </tbody>
</table>
