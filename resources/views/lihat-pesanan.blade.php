<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="mb-8 text-3xl font-bold text-center text-gray-800">Daftar Pesanan</h2>

            @if (session('success'))
                <div class="p-4 mb-4 text-white bg-green-500 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="hidden overflow-hidden border border-gray-200 shadow-sm md:block sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Menu</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Telepon</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Harga Satuan</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Pembayaran</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">Status</th>
                                @if (Auth::check() && Auth::user()->role === 'admin')
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-white uppercase" colspan="2">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($pesanans->groupBy('name') as $customerName => $orders)
                                <tr class="bg-gray-100">
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap" colspan="{{ (Auth::check() && Auth::user()->role === 'admin') ? 9 : 7 }}">
                                        {{ $customerName }}
                                    </td>
                                </tr>
                                @foreach ($orders as $order)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $order->menu }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $order->quantity }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $order->phone ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">Rp{{ number_format($order->Harga / $order->quantity, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                            {{ $order->Pembayaran ?? 'N/A' }}
                                            @if ($order->bukti_transfer)
                                                <button onclick="showModal('{{ asset("storage/{$order->bukti_transfer}") }}')" class="ml-2 text-xs text-blue-500 hover:underline">(Lihat Bukti)</button>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($order->status === 'approved')
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Disetujui</span>
                                            @else
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">Menunggu</span>
                                            @endif
                                        </td>
                                        @if (Auth::check() && Auth::user()->role === 'admin')
                                            <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                                @if ($order->status !== 'approved')
                                                    <form action="{{ route('pesanan.approve', $order->id) }}" method="POST"> @csrf <button type="submit" class="text-indigo-600 hover:text-indigo-900">Approve</button> </form>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                                <form action="{{ route('pesanan.destroy', $order->id) }}" method="POST"> @csrf @method('DELETE') <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button> </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                <tr class="bg-orange-100">
                                    <td colspan="4" class="px-6 py-3 text-sm font-bold text-right text-gray-800">TOTAL:</td>
                                    <td colspan="5" class="px-6 py-3 text-sm font-bold text-orange-600">Rp{{ number_format($orders->sum('Harga'), 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr><td class="px-6 py-4 text-center text-gray-500" colspan="9">Belum ada pesanan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:hidden">
                @forelse ($pesanans->groupBy('name') as $customerName => $orders)
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <h3 class="mb-4 text-lg font-bold text-center text-gray-900">{{ $customerName }}</h3>
                        <div class="space-y-4">
                            @foreach ($orders as $order)
                                <div class="p-4 bg-white rounded-lg shadow">
                                    <div class="flex justify-between pb-2 mb-2 border-b">
                                        <p class="font-bold">{{ $order->menu }} ({{ $order->quantity }}x)</p>
                                        <p class="font-semibold">Rp{{ number_format($order->Harga, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="space-y-1 text-sm text-gray-600">
                                        <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>
                                        <p><strong>Telepon:</strong> {{ $order->phone ?? '-' }}</p>
                                        <p><strong>Pembayaran:</strong> {{ $order->Pembayaran ?? 'N/A' }}
                                            @if ($order->bukti_transfer)
                                                <button onclick="showModal('{{ asset("storage/{$order->bukti_transfer}") }}')" class="ml-2 text-blue-500 hover:underline">(Lihat Bukti)</button>
                                            @endif
                                        </p>
                                        <p class="flex items-center"><strong>Status:</strong>&nbsp;
                                            @if ($order->status === 'approved')
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Disetujui</span>
                                            @else
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">Menunggu</span>
                                            @endif
                                        </p>
                                    </div>
                                    @if (Auth::check() && Auth::user()->role === 'admin')
                                        <div class="flex justify-end pt-3 mt-3 space-x-4 border-t">
                                            @if ($order->status !== 'approved')
                                                <form action="{{ route('pesanan.approve', $order->id) }}" method="POST"> @csrf <button type="submit" class="px-3 py-1 text-xs text-white bg-green-500 rounded-md">Approve</button> </form>
                                            @endif
                                            <form action="{{ route('pesanan.destroy', $order->id) }}" method="POST"> @csrf @method('DELETE') <button type="submit" class="px-3 py-1 text-xs text-white bg-red-500 rounded-md">Hapus</button> </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            <div class="p-3 mt-4 font-bold text-right bg-orange-100 rounded-lg">
                                Total: <span class="text-orange-600">Rp{{ number_format($orders->sum('Harga'), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500 bg-white rounded-lg shadow">
                        Belum ada pesanan.
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-75"><div class="relative p-4 bg-white rounded-lg"><button onclick="closeModal()" class="absolute flex items-center justify-center w-8 h-8 text-white bg-red-600 rounded-full -top-3 -right-3 hover:bg-red-700">&times;</button><img id="modalImage" src="" alt="Bukti Transfer" class="max-w-screen-md max-h-screen"></div></div><script>function showModal(imageUrl){document.getElementById('modalImage').src=imageUrl;document.getElementById('imageModal').classList.remove('hidden')}function closeModal(){document.getElementById('imageModal').classList.add('hidden')}</script>
</x-app-layout>
