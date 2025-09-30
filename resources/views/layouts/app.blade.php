
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
        
        <!-- Navigation -->
        <nav class="bg-white shadow-md backdrop-blur-sm bg-opacity-90">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <!-- Logo + Nama -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo_kopi.jpg') }}" 
                         alt="Logo Coffee Gallery" 
                         class="w-12 h-auto rounded-lg shadow-md">
                    <span class="text-xl font-bold text-gray-800">Coffee Gallery</span>
                </div>

                <!-- Menu Navigasi -->
                <div class="space-x-6 text-gray-700 font-semibold">
                    <a href="{{ url('/') }}" class="hover:text-yellow-600 transition">Home</a>
                    <a href="{{ route('login') }}" class="hover:text-yellow-600 transition">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-yellow-600 transition">Register</a>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-md backdrop-blur-sm bg-opacity-90">
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

        <!-- Page Content -->
        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transition duration-300">
                    {{ $slot }}
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 py-6 text-center text-sm">
            <div class="flex justify-center items-center space-x-3">
                <img src="{{ asset('images/logo_kopi.jpg') }}" 
                     alt="Logo Coffee Gallery" 
                     class="w-8 h-auto rounded">
                <span>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</span>
            </div>
        </footer>
    </div>
</body>
</html>

