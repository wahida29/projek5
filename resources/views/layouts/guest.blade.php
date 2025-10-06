<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Caffee Gallery') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

        {{-- Background dengan foto --}}
        <div class="relative flex flex-col items-center justify-center min-h-screen bg-cover bg-center" 
             style="background-image: url('{{ asset('img/biji.jpg') }}');">

            {{-- Overlay lebih gelap biar tulisan jelas --}}
            <div class="absolute inset-0 bg-black/80"></div>

            {{-- Card form --}}
            <div class="relative w-full max-w-md px-8 py-8 overflow-hidden bg-white/10 backdrop-blur-md shadow-2xl rounded-xl">
                
                {{-- Logo + Judul --}}
                <div class="mb-6 text-center">
                    <a href="/">
                        <img src="{{ asset('img/logo_kopi.jpg') }}" alt="Logo" class="w-24 h-24 mx-auto rounded-full shadow-lg">
                    </a>
                    <h1 class="mt-4 text-3xl font-bold text-white drop-shadow-lg">
                        Selamat Datang di Caffee Gallery
                    </h1>
                    <p class="mt-1 text-white drop-shadow-md">
                        Daftar sekarang untuk melanjutkan pesanan Anda.
                    </p>
                </div>

                {{-- Slot Form Laravel Breeze --}}
                <div class="space-y-4 text-white">
                    {{ $slot }}
                </div>
            </div>
        </div>

    </body>
</html>
