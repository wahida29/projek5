<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Coffee Gallery') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-800 bg-gray-50">
        <div class="flex flex-col min-h-screen">
            {{-- Navbar --}}
            @include('layouts.navigation')

            {{-- Header jika ada --}}
            @isset($header)
                <header class="bg-white shadow-sm">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Konten utama --}}
            <main class="flex-1">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="py-6 mt-8 text-gray-300 bg-gray-900">
                <div class="px-4 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
                    <h3 class="text-xl font-semibold text-white">Krusit</h3>
                    <p class="mt-2 text-sm">
                        Solusi kreatif untuk berbagi ide dan inovasi digital.
                    </p>
                    <p class="mt-4 space-x-4">
                        <a href="{{ url('/register') }}" class="font-medium text-orange-400 hover:text-orange-500">Daftar Sekarang</a>
                        <span class="text-gray-500">|</span>
                        <a href="{{ url('/login') }}" class="font-medium text-orange-400 hover:text-orange-500">Masuk</a>
                    </p>
                    <p class="mt-4 text-xs text-gray-500">&copy; 2025 coffee Gallery. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
