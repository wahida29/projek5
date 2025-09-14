<x-app-layout>
    @if (Auth::check() && Auth::user()->role === 'admin')
    <div class="container px-4 py-8 mx-auto">
        <h1 class="mb-4 text-2xl font-bold">Edit Menu</h1>
        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-red-500 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('barang.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="p-6 bg-white rounded-lg shadow-md">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold text-gray-700">Nama Menu:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $menu->name) }}" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-lg font-semibold text-gray-700">Deskripsi:</label>
                <textarea id="description" name="description" class="w-full p-2 border border-gray-300 rounded-lg">{{ old('description', $menu->description) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="category" class="block text-lg font-semibold text-gray-700">Kategori:</label>
                <select id="category" name="category" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <option value="makanan" {{ old('category', $menu->category) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                    <option value="minuman" {{ old('category', $menu->category) == 'minuman' ? 'selected' : '' }}>Minuman</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-lg font-semibold text-gray-700">Harga:</label>
                <input type="number" id="price" name="price" value="{{ old('price', $menu->price) }}" class="w-full p-2 border border-gray-300 rounded-lg" min="0" step="0.01" required>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-lg font-semibold text-gray-700">Gambar:</label>
                <input type="file" id="image" name="image" class="w-full p-2 border border-gray-300 rounded-lg" accept="image/*">
                @if ($menu->image)
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-32 h-32 mt-4">
                @endif
            </div>
            <div class="text-center">
                <button type="submit" class="px-6 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Update Barang</button>
            </div>
        </form>
    </div>
    @endif
</x-app-layout>
