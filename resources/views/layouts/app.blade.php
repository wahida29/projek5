<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Coffee Gallery') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300">
    <div class="min-h-screen flex flex-col">

        <!-- ✅ Navigation -->
        <nav class="bg-white shadow-md backdrop-blur-sm bg-opacity-90 fixed w-full top-0 left-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                
                <!-- Logo + Nama -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo_kopi.jpg') }}" 
                         alt="Logo Coffee Gallery" 
                         class="w-10 h-auto rounded-lg shadow-md">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800 hover:text-yellow-600 transition">
                        Coffee Gallery
                    </a>
                </div>

                <!-- Menu Navigasi -->
                <div class="space-x-6 text-gray-700 font-semibold hidden md:flex">

                    {{-- Jika belum login --}}
                    @guest
                        <a href="{{ url('/') }}" class="hover:text-yellow-600 transition">Home</a>
                        <a href="{{ route('login') }}" class="hover:text-yellow-600 transition">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-yellow-600 transition">Register</a>
                    @endguest

                    {{-- Jika sudah login --}}
                    @auth
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-yellow-600' : 'hover:text-yellow-600' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('kopi') }}" class="{{ request()->routeIs('kopi') ? 'text-yellow-600' : 'hover:text-yellow-600' }}">
                            Coffee
                        </a>
                        <a href="{{ route('nonkopi') }}" class="{{ request()->routeIs('nonkopi') ? 'text-yellow-600' : 'hover:text-yellow-600' }}">
                            Non Coffee
                        </a>
                        <a href="{{ route('pesanan.index') }}" class="{{ request()->routeIs('pesanan.index') ? 'text-yellow-600' : 'hover:text-yellow-600' }}">
                            Pesanan
                        </a>

                        {{-- Khusus Admin --}}
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.index') ? 'text-yellow-600' : 'hover:text-yellow-600' }}">
                                Edit Menu
                            </a>
                            <a href="{{ route('barang.create') }}" class="{{ request()->routeIs('barang.create') ? 'text-yellow-600' : 'hover:text-yellow-600' }}">
                                Tambah Menu
                            </a>
                        @endif

                        {{-- Profil + Logout --}}
                        <div class="inline-block">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-red-600 transition">
                                    Logout ({{ Auth::user()->name }})
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>

                <!-- Menu Burger (Mobile) -->
                <div class="md:hidden">
                    <button id="menu-toggle" class="text-gray-600 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Menu Dropdown Mobile -->
            <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md">
                <div class="flex flex-col items-center py-4 space-y-3 text-gray-700 font-semibold">

                    @guest
                        <a href="{{ url('/') }}" class="hover:text-yellow-600 transition">Home</a>
                        <a href="{{ route('login') }}" class="hover:text-yellow-600 transition">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-yellow-600 transition">Register</a>
                    @endguest

                    @auth
                        <a href="{{ route('dashboard') }}" class="hover:text-yellow-600 transition">Dashboard</a>
                        <a href="{{ route('kopi') }}" class="hover:text-yellow-600 transition">Coffee</a>
                        <a href="{{ route('nonkopi') }}" class="hover:text-yellow-600 transition">Non Coffee</a>
                        <a href="{{ route('pesanan.index') }}" class="hover:text-yellow-600 transition">Pesanan</a>
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('barang.index') }}" class="hover:text-yellow-600 transition">Edit Menu</a>
                            <a href="{{ route('barang.create') }}" class="hover:text-yellow-600 transition">Tambah Menu</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                Logout ({{ Auth::user()->name }})
                            </button>
                        </form>
                    @endauth
                </div>
            </div>

            <script>
                document.getElementById('menu-toggle').addEventListener('click', function () {
                    document.getElementById('mobile-menu').classList.toggle('hidden');
                });
            </script>
        </nav>

        <!-- ✅ Page Heading -->
        @isset($header)
            <header class="bg-white shadow-md backdrop-blur-sm bg-opacity-90 mt-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex items-center space-x-4">
                    <img src="{{ asset('images/logo_kopi.jpg') }}" 
                         alt="Logo Coffee Gallery" 
                         class="w-10 h-auto">
                    <h1 class="text-2xl font-bold text-gray-800 tracking-tight">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endisset

        <!-- ✅ Page Content -->
        <main class="flex-1 mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transition duration-300">
                    {{ $slot }}
                </div>
            </div>
        </main>

        <!-- ✅ Footer -->
        <footer class="bg-gray-900 text-gray-400 py-6 text-center text-sm mt-auto">
            <div class="flex justify-center items-center space-x-3">
                <img src="{{ asset('images/logo_kopi.jpg') }}" 
                     alt="Logo Coffee Gallery" 
                     class="w-8 h-auto rounded">
                <span>© {{ date('Y') }} {{ config('app.name', 'Coffee Gallery') }}. All rights reserved.</span>
            </div>
        </footer>
    </div>
</body>
</html>
