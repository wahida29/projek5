<x-app-layout>
    <div class="container px-4 py-8 mx-auto">
        <h2 class="mb-10 text-3xl font-bold text-center text-orange-400">Menu Minuman</h2>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($menus as $menu)
                <div class="relative flex flex-col items-center group">
                    <!-- Gambar -->
                    <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                        @if ($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }} "
                                class="object-cover w-40 h-40 mx-auto transition-transform duration-300 ease-in-out group-hover:scale-105">
                        @else
                            <img src="/img/default.png" alt="Default Image"
                                class="object-cover w-40 h-40 mx-auto transition-transform duration-300 ease-in-out group-hover:scale-105">
                        @endif
                    </div>

                    <!-- Informasi Produk -->
                    <div class="w-full px-4 py-2 text-center transition-all duration-300 bg-gray-200 group-hover:bg-gray-300">
                        <h3 class="text-lg font-bold">{{ $menu->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $menu->description ?: 'Deskripsi tidak tersedia.' }}</p>
                        <p class="mt-1 text-lg font-semibold text-orange-500">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Formulir Pemesanan -->
        <form action="{{ route('pesan.store') }}" method="POST" class="p-6 mt-10 bg-white rounded-lg shadow-lg" id="orderForm" enctype="multipart/form-data">
            @csrf
            <h2 class="mb-4 text-2xl font-bold text-center text-orange-500">Silahkan Pesan</h2>

            <div class="mb-4">
                <label for="name" class="block mb-2 font-bold text-gray-700">Nama Anda</label>
                <input type="text" id="name" name="name" class="w-full p-2 border rounded-lg" required>
            </div>

            <div id="menu-container" class="space-y-4">
                <div class="flex items-center space-x-4 menu-item">
                    <select name="menus[0][menu]" class="w-full px-4 py-2 bg-white border rounded-lg" required>
                        <option value="" disabled selected>Pilih Menu</option>
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->name }}" data-price="{{ $menu->price }}">
                                {{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>

                    <input type="number" name="menus[0][quantity]" class="w-20 p-2 border rounded-lg" placeholder="Jumlah" min="1" required>

                    <button type="button" class="px-3 py-2 text-white bg-red-500 rounded-lg remove-menu-item">
                        Hapus
                    </button>
                </div>
            </div>

            <button type="button" id="add-menu-item" class="px-4 py-2 mt-4 text-white bg-orange-500 rounded-lg">
                Tambah Menu
            </button>

            <div class="mt-4">
                <label for="phone" class="block mb-2 font-bold text-gray-700">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" class="w-full p-2 border rounded-lg" required>
            </div>

            <div class="mt-4">
                <label for="pembayaran" class="block mb-2 font-bold text-gray-700">Pembayaran</label>
                <select id="Pembayaran" name="Pembayaran" class="w-full px-4 py-2 bg-white border rounded-lg" required>
                    <option value="" disabled selected>Pilih Metode Pembayaran</option>
                    <option value="Cash">Cash</option>
                    <option value="Transfer">Transfer</option>
                </select>
            </div>

            <!-- Tampilkan Nomor Rekening Perusahaan jika Transfer dipilih -->
            <div id="nomor-rekening" class="hidden mt-4">
                <p class="text-sm text-gray-600">Nomor Rekening Perusahaan: 123-456-789 (Bank ABC)</p>
            </div>

            <!-- Input Bukti Pembayaran jika Transfer dipilih -->
            <div id="bukti-transfer" class="hidden mt-4">
                <label for="bukti_pembayaran" class="block mb-2 font-bold text-gray-700">Bukti Pembayaran</label>
                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="w-full p-2 border rounded-lg" accept="image/*">
            </div>

            <div class="mt-4">
                <label for="Harga" class="block mb-2 font-bold text-gray-700">Total Harga</label>
                <input type="hidden" id="Harga" name="Harga">
                <input type="text" id="total_harga_display" class="w-full p-2 border rounded-lg" readonly>
            </div>

            <button type="button" class="w-full py-2 mt-4 text-white bg-orange-500 rounded-lg hover:bg-orange-600" id="confirmOrderButton">
                Kirim Pesanan
            </button>
        </form>

        <!-- Confirmation Modal -->
        <div id="confirmationModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
            <div class="p-6 text-center bg-white rounded-lg shadow-lg">
                <h3 class="mb-4 text-lg font-bold text-gray-800">Konfirmasi Pesanan</h3>
                <p class="mb-4 text-gray-600">Apakah Anda yakin ingin melanjutkan pesanan?</p>
                <div class="flex justify-center space-x-4">
                    <button id="cancelOrderButton" class="px-6 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">
                        Batal
                    </button>
                    <button id="submitOrderButton" class="px-6 py-2 text-white bg-orange-500 rounded-lg hover:bg-orange-600">
                        Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuContainer = document.getElementById('menu-container');
            const addMenuItemButton = document.getElementById('add-menu-item');
            const totalHargaInput = document.getElementById('Harga');
            const totalHargaDisplay = document.getElementById('total_harga_display');
            const orderForm = document.getElementById('orderForm');
            const confirmationModal = document.getElementById('confirmationModal');
            const confirmOrderButton = document.getElementById('confirmOrderButton');
            const cancelOrderButton = document.getElementById('cancelOrderButton');
            const submitOrderButton = document.getElementById('submitOrderButton');
            const pembayaranSelect = document.getElementById('Pembayaran');
            const buktiTransferDiv = document.getElementById('bukti-transfer');
            const nomorRekeningDiv = document.getElementById('nomor-rekening');

            // Function to calculate total price
            function calculateTotalPrice() {
                let totalPrice = 0;
                menuContainer.querySelectorAll('.menu-item').forEach(item => {
                    const select = item.querySelector('select');
                    const quantityInput = item.querySelector('input[type="number"]');
                    const price = parseFloat(select.options[select.selectedIndex]?.dataset.price || 0);
                    const quantity = parseInt(quantityInput.value || 0);
                    totalPrice += price * quantity;
                });

                totalHargaInput.value = totalPrice;
                totalHargaDisplay.value = totalPrice.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            }

            // Add new menu item
            addMenuItemButton.addEventListener('click', () => {
                const menuItemsCount = menuContainer.querySelectorAll('.menu-item').length;
                const newMenuItem = document.createElement('div');
                newMenuItem.classList.add('menu-item', 'flex', 'space-x-4', 'items-center');
                newMenuItem.innerHTML = `
                    <select name="menus[${menuItemsCount}][menu]" class="w-full px-4 py-2 bg-white border rounded-lg" required>
                        <option value="" disabled selected>Pilih Menu</option>
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->name }}" data-price="{{ $menu->price }}">
                                {{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    <input type="number" name="menus[${menuItemsCount}][quantity]" class="w-20 p-2 border rounded-lg" placeholder="Jumlah" min="1" required>
                    <button type="button" class="px-3 py-2 text-white bg-red-500 rounded-lg remove-menu-item">Hapus</button>
                `;
                menuContainer.appendChild(newMenuItem);

                newMenuItem.querySelector('select').addEventListener('change', calculateTotalPrice);
                newMenuItem.querySelector('input[type="number"]').addEventListener('input', calculateTotalPrice);
                newMenuItem.querySelector('.remove-menu-item').addEventListener('click', () => {
                    newMenuItem.remove();
                    calculateTotalPrice();
                });

                calculateTotalPrice(); // Update total price immediately after adding menu item
            });

            // Calculate total price on change
            menuContainer.addEventListener('change', calculateTotalPrice);
            menuContainer.addEventListener('input', calculateTotalPrice);

            // Show/hide bukti pembayaran and nomor rekening based on payment method
            pembayaranSelect.addEventListener('change', () => {
                if (pembayaranSelect.value === 'Transfer') {
                    buktiTransferDiv.classList.remove('hidden');
                    nomorRekeningDiv.classList.remove('hidden');
                } else {
                    buktiTransferDiv.classList.add('hidden');
                    nomorRekeningDiv.classList.add('hidden');
                }
            });

            // Show confirmation modal
            confirmOrderButton.addEventListener('click', () => {
                confirmationModal.classList.remove('hidden');
            });

            // Cancel the order
            cancelOrderButton.addEventListener('click', () => {
                confirmationModal.classList.add('hidden');
            });

            // Submit the order
            submitOrderButton.addEventListener('click', () => {
                confirmationModal.classList.add('hidden');
                orderForm.submit();
            });
        });
    </script>

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
</x-app-layout>
