<x-app-layout>
    <div class="relative flex items-center justify-center h-screen mt-16 bg-center bg-cover" style="background-image: url('/img/kopii.jpg');">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>

        <div class="relative z-10 px-6 text-center text-white animate-fade-in-up">
            <h1 class="text-5xl font-extrabold tracking-tight md:text-7xl" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
                Secangkir Kopi akan terasa nikmat kalau dinikmati bareng momen yang pas
            </h1>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-200 md:text-xl">
                Selamat datang di <strong>Caffee Gallery</strong>, tempat di mana setiap tegukan kopi penuh rasa dan makna.
            </p>
            <div class="mt-8">
                <a href="{{ route('kopi') }}" class="px-8 py-3 text-lg font-bold text-gray-900 transition duration-300 transform bg-orange-400 rounded-full shadow-lg hover:bg-orange-300 hover:scale-105">
                    Lihat Menu
                </a>
            </div>
        </div>
    </div>

    <section class="py-16 bg-gray-50">
        <div class="container px-4 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900">Mengapa Memilih Caffee Gallery?</h2>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-600">
                Kami percaya kualitas adalah segalanya. Setiap produk kami dibuat dengan cinta dan bahan terbaik.
            </p>
        </div>
    </section>
</x-app-layout>
