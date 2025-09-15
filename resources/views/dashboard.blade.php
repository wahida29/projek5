@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <div class="relative flex items-center justify-center h-screen bg-center bg-cover" style="background-image: url('/img/krusit2.png');">
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <div class="relative z-10 px-4 text-center text-white">
            <h1 class="text-5xl font-semibold md:text-6xl drop-shadow-lg">
                Nikmati Setiap Menu Yang Murah
            </h1>
            <p class="mt-4 text-5xl font-semibold md:text-6xl drop-shadow-lg">
                Hanya Di <span class="block mt-4 font-extrabold text-orange-400 text-7xl md:text-8xl">KRUSIT</span>
            </p>

            <div class="mt-8">
                <a href="{{ url('/menu') }}" class="px-6 py-3 text-lg font-semibold text-white transition bg-orange-500 rounded-full shadow-lg hover:bg-orange-600">
                    Pesan Sekarang
                </a>
            </div>
        </div>
    </div>

    {{-- Highlight Section --}}
    <section class="py-16 text-white bg-orange-400">
        <div class="container px-4 mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8 text-center md:grid-cols-4">

                <div class="p-4 transition duration-300 transform hover:scale-110">
                    <h3 class="text-2xl font-bold tracking-wider md:text-3xl">HALAL</h3>
                </div>

                <div class="p-4 transition duration-300 transform hover:scale-110">
                    <h3 class="text-2xl font-bold tracking-wider md:text-3xl">CRISPY</h3>
                </div>

                <div class="p-4 transition duration-300 transform hover:scale-110">
                    <h3 class="text-2xl font-bold tracking-wider md:text-3xl">KRUNCHY</h3>
                </div>

                <div class="p-4 transition duration-300 transform hover:scale-110">
                    <h3 class="text-2xl font-bold tracking-wider md:text-3xl">JUICY</h3>
                </div>

            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-8 text-gray-300 bg-gray-900">
        <div class="container px-4 mx-auto text-center">
            <h3 class="text-xl font-semibold text-white">Krusit</h3>
            <p class="mt-2 text-sm">Solusi kreatif untuk berbagi ide dan inovasi digital.</p>
            <p class="mt-4 text-xs text-gray-500">&copy; {{ date('Y') }} KRUSIT. All rights reserved.</p>

            <div class="flex justify-center mt-4 space-x-6">
                <a href="#" class="transition hover:text-orange-400">Facebook</a>
                <a href="#" class="transition hover:text-orange-400">Instagram</a>
                <a href="#" class="transition hover:text-orange-400">Twitter</a>
            </div>
        </div>
    </footer>
@endsection
