<x-app-layout>
    <div class="container px-4 py-8 mx-auto">
        <h2 class="mb-10 text-3xl font-bold text-center text-orange-400">Menu Kami</h2>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($menus as $menu)
                <div class="relative flex flex-col items-center group">
                    <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                        @if ($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-40 h-40 mx-auto transition-transform duration-300 ease-in-out group-hover:scale-105">
                        @else
                            <img src="/img/default.png" alt="Default Image" class="object-cover w-40 h-40 mx-auto transition-transform duration-300 ease-in-out group-hover:scale-105">
                        @endif
                    </div>
                    <div class="w-full px-4 py-2 text-center transition-all duration-300 bg-gray-200 group-hover:bg-gray-300">
                        <h3 class="text-lg font-bold">{{ $menu->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $menu->description ?: 'Deskripsi tidak tersedia.' }}</p>
                        <p class="mt-1 text-lg font-semibold text-orange-500">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('pesanan.store') }}" method="POST" class="p-6 mt-10 bg-white rounded-lg shadow-lg" id="orderForm" enctype="multipart/form-data">
            @csrf
            <h2 class="mb-4 text-2xl font-bold text-center text-orange-500">Formulir Pemesanan</h2>

            <div class="mb-4">
                <label for="nama_pemesan" class="block mb-2 font-bold text-gray-700">Nama Anda</label>
                <input type="text" id="nama_pemesan" name="nama_pemesan" value="{{ auth()->user()->name }}" class="w-full p-2 bg-gray-100 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="nomor_telepon" class="block mb-2 font-bold text-gray-700">Nomor Telepon</label>
                <input type="text" id="nomor_telepon" name="nomor_telepon" class="w-full p-2 border rounded-lg" required>
            </div>

            <div id="menu-container" class="space-y-4">
                <div class="flex items-center space-x-4 menu-item">
                    <select name="items[0][barang_id]" class="w-full px-4 py-2 bg-white border rounded-lg menu-select" required>
                        <option value="" data-price="0" disabled selected>Pilih Menu</option>
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">
                                {{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    <input type="number" name="items[0][jumlah]" class="w-24 p-2 text-center border rounded-lg jumlah-input" placeholder="Jumlah" min="1" value="1" required>
                    <button type="button" class="px-3 py-2 text-white bg-red-500 rounded-lg remove-menu-item">Hapus</button>
                </div>
            </div>

            <button type="button" id="add-menu-item" class="px-4 py-2 mt-4 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                + Tambah Menu Lain
            </button>

            <div class="mt-4">
                <label for="pembayaran" class="block mb-2 font-bold text-gray-700">Pembayaran</label>
                <select id="pembayaran" name="pembayaran" class="w-full px-4 py-2 bg-white border rounded-lg" required>
                    <option value="" disabled selected>Pilih Metode Pembayaran</option>
                    <option value="Cash">Cash</option>
                    <option value="Transfer">Transfer</option>
                </select>
            </div>

            <div id="transfer-info" class="hidden mt-4 space-y-4">
                <div class="p-3 text-sm text-blue-800 bg-blue-100 border border-blue-300 rounded-lg">
                    <p class="font-semibold">Nomor Rekening: 123-456-789 (Bank ABC)</p>
                    <p>Silakan lakukan transfer sesuai total harga dan unggah bukti pembayaran.</p>
                </div>
                <div>
                    <label for="bukti_pembayaran" class="block mb-2 font-bold text-gray-700">Unggah Bukti Pembayaran</label>
                    <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="w-full p-2 text-sm border rounded-lg" accept="image/*">
                </div>
            </div>

            <div class="mt-6">
                <label for="total_harga_display" class="block mb-2 text-lg font-bold text-gray-700">Total Harga</label>
                <input type="text" id="total_harga_display" class="w-full p-3 text-2xl font-bold text-right bg-gray-100 border rounded-lg" readonly>
            </div>

            <button type="submit" class="w-full py-3 mt-6 text-lg font-bold text-white bg-orange-500 rounded-lg hover:bg-orange-600">
                Kirim Pesanan
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuContainer = document.getElementById('menu-container');
            const addMenuItemButton = document.getElementById('add-menu-item');
            const totalHargaDisplay = document.getElementById('total_harga_display');
            const orderForm = document.getElementById('orderForm');
            const pembayaranSelect = document.getElementById('pembayaran');
            const transferInfoDiv = document.getElementById('transfer-info');

            // --- FUNGSI UTAMA UNTUK MENGHITUNG TOTAL ---
            function calculateTotal() {
                let totalPrice = 0;
                menuContainer.querySelectorAll('.menu-item').forEach(item => {
                    const select = item.querySelector('.menu-select');
                    const quantityInput = item.querySelector('.jumlah-input');
                    const selectedOption = select.options[select.selectedIndex];

                    if (selectedOption) {
                        const price = parseFloat(selectedOption.dataset.price || 0);
                        const quantity = parseInt(quantityInput.value || 0);
                        totalPrice += price * quantity;
                    }
                });

                totalHargaDisplay.value = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(totalPrice);
            }

            // --- FUNGSI UNTUK MENAMBAH ITEM MENU BARU ---
            function addMenuItem() {
                const menuItemsCount = menuContainer.querySelectorAll('.menu-item').length;
                const newMenuItem = document.createElement('div');
                newMenuItem.className = 'flex items-center space-x-4 menu-item';

                // Kloning baris pertama dan sesuaikan namanya
                const firstItem = menuContainer.querySelector('.menu-item');
                newMenuItem.innerHTML = firstItem.innerHTML;
                newMenuItem.querySelector('select').name = `items[${menuItemsCount}][barang_id]`;
                newMenuItem.querySelector('input').name = `items[${menuItemsCount}][jumlah]`;
                newMenuItem.querySelector('select').value = ""; // Reset pilihan
                newMenuItem.querySelector('input').value = "1"; // Reset jumlah

                menuContainer.appendChild(newMenuItem);
            }

            // --- EVENT LISTENERS ---

            // Tambah Menu
            addMenuItemButton.addEventListener('click', addMenuItem);

            // Hapus Menu, ganti jumlah, atau pilih menu
            menuContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-menu-item')) {
                    // Hanya hapus jika ada lebih dari 1 item
                    if (menuContainer.querySelectorAll('.menu-item').length > 1) {
                        e.target.closest('.menu-item').remove();
                        calculateTotal();
                    }
                }
            });

            menuContainer.addEventListener('change', function(e) {
                if (e.target.classList.contains('menu-select')) {
                    calculateTotal();
                }
            });

            menuContainer.addEventListener('input', function(e) {
                if (e.target.classList.contains('jumlah-input')) {
                    calculateTotal();
                }
            });

            // Tampilkan/sembunyikan info transfer
            pembayaranSelect.addEventListener('change', () => {
                transferInfoDiv.classList.toggle('hidden', pembayaranSelect.value !== 'Transfer');
            });

            // Hitung total saat halaman pertama kali dimuat
            calculateTotal();
        });
    </script>
</x-app-layout>
