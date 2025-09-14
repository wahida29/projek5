<x-app-layout>
    <div class="container px-4 py-8 mx-auto">
        <h2 class="mb-6 text-2xl font-bold text-center text-orange-400">Pesan Makanan</h2>
        <div class="max-w-lg p-6 mx-auto bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-xl font-semibold">{{ $menu->name }}</h3>
            <p class="mb-2 text-gray-600">Harga: Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                <div class="mb-4">
                    <label for="quantity" class="block mb-1 text-sm text-gray-700">Jumlah</label>
                    <input type="number" name="quantity" id="quantity" min="1" required class="w-full px-3 py-2 border rounded">
                </div>
                <button type="submit" class="w-full px-3 py-2 text-white bg-orange-400 rounded hover:bg-orange-500">Pesan</button>
            </form>
        </div>
    </div>
</x-app-layout>
