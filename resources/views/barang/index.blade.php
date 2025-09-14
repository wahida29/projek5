<x-app-layout>
    @if (Auth::check() && Auth::user()->role === 'admin')
    <div class="container px-4 py-8 mx-auto">
        <h1 class="mb-4 text-2xl font-bold">Daftar Menu</h1>
        @if(session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('barang.create') }}" class="inline-block px-4 py-2 mb-4 text-white bg-green-500 rounded-lg hover:bg-green-600">Tambah Menu</a>
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Gambar</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Deskripsi</th>
                    <th class="px-4 py-2 border">Harga</th>
                    <th class="px-4 py-2 border">Kategori</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td class="px-4 py-2 border">
                            @if ($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-16 h-16">
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-2 border">{{ $menu->name }}</td>
                        <td class="px-4 py-2 border">{{ $menu->description }}</td>
                        <td class="px-4 py-2 border">Rp{{ number_format($menu->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($menu->category) }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('barang.edit', $menu->id) }}" class="px-2 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Edit</a>
                            <form action="{{ route('barang.destroy', $menu->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 text-white bg-red-500 rounded hover:bg-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</x-app-layout>
