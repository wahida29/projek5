@extends('layouts.app')

@section('content')

    {{-- Hero Section --}}
    <div class="relative flex items-center justify-center h-screen bg-center bg-cover bg-hero-krusit">
        <div class="absolute inset-0 bg-black opacity-60"></div>

        <div class="relative z-10 px-4 text-center text-white">
            <h1 class="text-5xl font-bold md:text-6xl" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.6);">
                Nikmati Setiap Gigitan Renyahnya
            </h1>
            <p class="mt-4 text-5xl font-bold md:text-6xl" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.6);">
                Hanya Di <span class="block mt-4 font-extrabold text-orange-400 text-7xl md:text-8xl">KRUSIT</span>
            </p>

            <div class="mt-10">
                <a href="{{ url('/menu') }}"
                   class="px-8 py-4 text-lg font-semibold text-white transition duration-300 transform bg-orange-500 rounded-full shadow-lg hover:bg-orange-600 hover:scale-105">
                    Pesan Sekarang
                </a>
            </div>
        </div>
    </div>

    {{-- Highlight Section --}}
    <section class="py-16 bg-white">
        <div class="container px-4 mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8 text-center md:grid-cols-4">

                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-center w-20 h-20 mb-4 text-orange-500 bg-orange-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold tracking-wider text-gray-700">100% HALAL</h3>
                </div>

                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-center w-20 h-20 mb-4 text-orange-500 bg-orange-100 rounded-full">
                       <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7.C14 5 16.09 5.777 17.657 7.343A8 8 0 0117.657 18.657z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold tracking-wider text-gray-700">SUPER CRISPY</h3>
                </div>

                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-center w-20 h-20 mb-4 text-orange-500 bg-orange-100 rounded-full">
                       <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold tracking-wider text-gray-700">BAHAN SEGAR</h3>
                </div>

                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-center w-20 h-20 mb-4 text-orange-500 bg-orange-100 rounded-full">
                       <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1h4a2 2 0 012 2v1h-6.401M12 6V5" /></svg>
                    </div>
                    <h3 class="text-xl font-bold tracking-wider text-gray-700">HARGA MURAH</h3>
                </div>

            </div>
        </div>
    </section>

    {{-- Menu Unggulan Section --}}
    <section class="py-20 bg-gray-50">
        <div class="container px-4 mx-auto text-center">
            <h2 class="mb-2 text-3xl font-bold text-gray-800 md:text-4xl">Menu Andalan Kami</h2>
            <p class="mb-12 text-gray-600">Dibuat dengan bahan-bahan pilihan yang renyah dan lezat.</p>



            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

                <div class="overflow-hidden text-left transition duration-300 transform bg-white rounded-lg shadow-lg hover:-translate-y-2">
                    <img src="https://via.placeholder.com/400x300.png/fb923c/ffffff?text=Pangsit+Ayam" alt="Pangsit Ayam Original" class="object-cover w-full h-56">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900">Pangsit Ayam Original</h3>
                        <p class="mt-2 text-gray-600">Rasa klasik yang tak pernah salah, renyah di luar, juicy di dalam.</p>
                        <div class="mt-4">
                            <span class="text-xl font-bold text-orange-500">Rp 15.000</span>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden text-left transition duration-300 transform bg-white rounded-lg shadow-lg hover:-translate-y-2">
                    <img src="https://via.placeholder.com/400x300.png/fb923c/ffffff?text=Pangsit+Pedas" alt="Pangsit Ayam Pedas" class="object-cover w-full h-56">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900">Pangsit Ayam Pedas</h3>
                        <p class="mt-2 text-gray-600">Sensasi pedas yang membakar semangat, cocok untuk pemberani.</p>
                        <div class="mt-4">
                            <span class="text-xl font-bold text-orange-500">Rp 17.000</span>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden text-left transition duration-300 transform bg-white rounded-lg shadow-lg hover:-translate-y-2">
                    <img src="https://via.placeholder.com/400x300.png/fb923c/ffffff?text=Pangsit+Keju" alt="Pangsit Mozzarella" class="object-cover w-full h-56">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900">Pangsit Mozzarella</h3>
                        <p class="mt-2 text-gray-600">Lelehan keju mozzarella gurih di setiap gigitan.</p>
                         <div class="mt-4">
                            <span class="text-xl font-bold text-orange-500">Rp 20.000</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-12">
                 <a href="{{ url('/menu') }}" class="px-6 py-3 font-semibold text-orange-600 transition duration-300 bg-transparent border-2 border-orange-500 rounded-full hover:bg-orange-500 hover:text-white">
                    Lihat Semua Menu
                </a>
            </div>
        </div>
    </section>

@endsection
