<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Krusit') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex flex-col items-center justify-center min-h-screen px-4 py-6 bg-gray-100">

            <div class="mb-6 text-center">
                <a href="/">
                    <x-application-logo class="w-24 h-24 mx-auto text-gray-700 fill-current" />
                </a>
                <h1 class="mt-4 text-3xl font-bold text-gray-800">
                    Selamat Datang di Krusit
                </h1>
                <p class="mt-1 text-gray-500">
                    Silakan masuk untuk melanjutkan pesanan Anda.
                </p>
            </div>

            <div class="w-full max-w-md px-8 py-8 overflow-hidden bg-white shadow-2xl rounded-xl">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
