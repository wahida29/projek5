<x-app-layout>
    <!-- Hero Section -->
    <section class="relative flex items-center justify-center min-h-screen font-sans bg-cover bg-center bg-no-repeat" 
        style="background-image: url('{{ asset('img/biji.jpg') }}');">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/70"></div>

        <!-- Konten -->
        <div class="relative z-10 flex flex-col items-center justify-center text-center text-white px-6 animate-fade-in-up">
            
            <!-- Logo -->
            <div class="mb-6">
                <img src="{{ asset('images/logo_kopi.jpg') }}" 
                     alt="Logo Coffee Gallery" 
                     class="w-28 md:w-40 lg:w-52 h-auto mx-auto object-contain drop-shadow-lg rounded-full bg-white/90 p-2">
            </div>

            <!-- Judul -->
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight drop-shadow-lg">
                COFFEE GALLERY
            </h1>

            <!-- Deskripsi -->
            <p class="mt-4 text-base md:text-lg lg:text-xl max-w-2xl text-gray-200 drop-shadow-md">
                Sajian kopi hangat dari biji pilihan terbaik. Rasakan aroma dan kenikmatan kopi yang membuat harimu lebih bersemangat.
            </p>

            <!-- Tombol Aksi -->
            <div class="flex flex-col md:flex-row gap-4 mt-10">
                @guest
                    <a href="{{ route('register') }}"
                       class="px-8 py-3 text-lg font-bold text-gray-900 bg-yellow-500 border-2 border-yellow-500 rounded-xl shadow-lg transition duration-300 transform hover:bg-yellow-400 hover:scale-105">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}"
                       class="px-8 py-3 text-lg font-bold text-white bg-transparent border-2 border-white rounded-xl shadow-lg backdrop-blur-sm transition duration-300 transform hover:bg-white hover:text-gray-900 hover:scale-105">
                        Masuk
                    </a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}"
                       class="px-8 py-3 text-lg font-bold text-gray-900 bg-yellow-500 border-2 border-yellow-500 rounded-xl shadow-lg transition duration-300 transform hover:bg-yellow-400 hover:scale-105">
                        Masuk ke Dashboard
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-gray-900 text-gray-400 py-6 text-center text-sm">
        <div class="flex justify-center items-center space-x-3">
            <img src="{{ asset('images/logo_kopi.jpg') }}" 
                 alt="Logo Coffee Gallery" 
                 class="w-8 h-auto rounded">
            <span>© {{ date('Y') }} Coffee Gallery. All rights reserved.</span>
        </div>
    </footer>
</x-app-layout>
