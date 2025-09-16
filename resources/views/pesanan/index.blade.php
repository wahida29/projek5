<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Riwayat Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 overflow-hidden bg-green-100 border-l-4 border-green-500 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-green-700">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="mb-4 text-2xl font-bold">Daftar Pesanan Anda</h3>
                    <div class="space-y-8">
                        @forelse ($pesanans as $pesanan)
                            <div class="p-4 border rounded-lg">
                                <div class="flex flex-col justify-between md:flex-row">
                                    <div>
                                        <h4 class="text-lg font-bold">Pesanan #{{ $pesanan->id }}</h4>
                                        <p class="text-sm text-gray-600">Pemesan: {{ $pesanan->nama_pemesan }}</p>
                                        <p class="text-sm text-gray-600">Tanggal: {{ $pesanan->created_at->format('d F Y, H:i') }}</p>
                                    </div>
                                    <div class="mt-4 text-left md:text-right">
                                        <p class="text-lg font-semibold">Total: Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $pesanan->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            Status: {{ ucfirst($pesanan->status) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-4 overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Menu</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jumlah</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Harga Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($pesanan->barangs as $barang)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $barang->nama_barang }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $barang->pivot->jumlah }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500">
                                <p>Anda belum memiliki riwayat pesanan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
