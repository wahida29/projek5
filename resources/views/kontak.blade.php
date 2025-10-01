<x-app-layout>
    <!-- Background Section -->
    <div class="relative h-screen py-12 bg-center rounded-lg" style="background-image: url('/img/krusit2.png'); background-size: cover; background-position: center;">
        <div class="relative z-20 px-6 mx-auto max-w-7xl sm:px-8">
            <div class="p-6 text-center">
                <p class="text-5xl font-semibold text-white" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);">
                    Selamat Datang di caffe kopi
                </p>
                <p class="mt-2 text-5xl font-semibold text-white" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);">
                    <span class="font-extrabold text-orange-400 text-7xl">minuman Favorit Anda</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <section class="py-12 bg-orange-400">
        <div class="container max-w-4xl mx-auto text-center">
            <div class="p-6 rounded-lg shadow-2xl bg-gradient-to-r from-orange-400 via-red-500 to-orange-400">
                <h3 class="text-5xl font-extrabold tracking-wide text-white">Hubungi Kami</h3>
                <p class="mt-4 text-4xl font-semibold text-gray-100">0812 3456 7890</p>
                <p class="mt-2 text-lg text-white">Untuk informasi lebih lanjut dan pemesanan</p>
                <a href="tel:081234567890" class="inline-block px-6 py-3 mt-4 text-lg font-bold text-orange-500 transition bg-white rounded-lg shadow-md hover:bg-gray-200">
                    Hubungi Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto text-center max-w-7xl">
            <h3 class="mb-6 text-4xl font-extrabold text-gray-800">Lokasi Kami</h3>
            <div class="relative w-full overflow-hidden rounded-lg shadow-lg h-96">
                <!-- Embed Google Maps -->
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63576.482771549825!2d119.39146467910159!3d-5.178986399999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee3bf2baf0669%3A0x334795a8585bb979!2sKrusit%20Makassar!5e0!3m2!1sid!2sid!4v1758048648962!5m2!1sid!2sid"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                ></iframe>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="py-6 text-white bg-gray-900">
        <div class="container mx-auto text-center">
            <p class="text-lg font-semibold">&copy; 2024 caffe kopi. All rights reserved.</p>
            <div class="flex justify-center mt-4 space-x-6">
                <a href="#" class="text-white transition hover:text-orange-400">Facebook</a>
                <a href="#" class="text-white transition hover:text-orange-400">Instagram</a>
                <a href="#" class="text-white transition hover:text-orange-400">Twitter</a>
            </div>
        </div>
    </footer>
</x-app-layout>
