<x-app-layout>

    <div class="relative flex items-center justify-center h-screen bg-center bg-cover" style="background-image: url('/img/krusit2.png');">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>

        <div class="relative z-10 px-6 text-center text-white animate-fade-in-up">
            <h1 class="text-5xl font-extrabold tracking-tight md:text-7xl" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
                Sensasi Renyah di Setiap Gigitan
            </h1>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-200 md:text-xl">
                Selamat datang di KRUSIT, tempat di mana kerenyahan dan rasa sempurna bertemu. Temukan camilan favorit baru Anda hari ini.
            </p>
            <div class="mt-8">
                <a href="{{ route('kopi') }}" class="px-8 py-3 text-lg font-bold text-gray-900 transition duration-300 transform bg-orange-400 rounded-full shadow-lg hover:bg-orange-300 hover:scale-105">
                    Lihat Menu
                </a>
            </div>
        </div>
    </div>

    <section class="py-16 bg-gray-50">
        <div class="container px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Mengapa Memilih KRUSIT?</h2>
                <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-600">Kami percaya kualitas adalah segalanya. Setiap produk kami dibuat dengan cinta dan bahan-bahan terbaik.</p>
            </div>
            <div class="grid grid-cols-1 gap-10 mt-12 text-center md:grid-cols-2 lg:grid-cols-4">
                <div class="p-6 transition duration-300 transform bg-white rounded-lg shadow-md hover:-translate-y-2">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 text-orange-500 bg-orange-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">100% Halal</h3>
                    <p class="mt-2 text-gray-600">Dibuat dari bahan-bahan yang terjamin kehalalannya untuk ketenangan Anda.</p>
                </div>
                <div class="p-6 transition duration-300 transform bg-white rounded-lg shadow-md hover:-translate-y-2">
                     <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 text-orange-500 bg-orange-100 rounded-full">
                       <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7.C14 5 16.09 5.777 17.657 7.343A8 8 0 0117.657 18.657z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Super Renyah</h3>
                    <p class="mt-2 text-gray-600">Tekstur renyah sempurna yang akan membuat Anda ketagihan.</p>
                </div>
                <div class="p-6 transition duration-300 transform bg-white rounded-lg shadow-md hover:-translate-y-2">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 text-orange-500 bg-orange-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Bahan Segar</h3>
                    <p class="mt-2 text-gray-600">Hanya menggunakan bahan baku segar dan bumbu pilihan berkualitas tinggi.</p>
                </div>
                <div class="p-6 transition duration-300 transform bg-white rounded-lg shadow-md hover:-translate-y-2">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 text-orange-500 bg-orange-100 rounded-full">
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V1m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Isian Melimpah</h3>
                    <p class="mt-2 text-gray-600">Isian yang lezat dan melimpah di setiap pangsit, memberikan rasa yang kaya.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-800">
        <div class="container px-4 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white">Apa Kata Mereka?</h2>
            <div class="max-w-3xl mx-auto mt-8">
                <div class="p-6 bg-gray-700 rounded-lg">
                    <p class="text-lg text-gray-300">"Krusit-nya benar-benar juara! Renyahnya pas, bumbunya terasa, dan bikin nggak bisa berhenti ngunyah. Wajib coba!"</p>
                    <p class="mt-4 font-bold text-orange-400">- Pelanggan Setia</p>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
