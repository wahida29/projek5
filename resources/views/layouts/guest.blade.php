<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-orange-300">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-orange-300 sm:justify-center sm:pt-0">
            <div class="mb-4 text-center">
                <a href="/">
                    <center><x-application-logo class="w-20 h-20 text-gray-500 fill-current" /></center>
                </a>
                <h1 class="mt-4 text-2xl font-semibold text-gray-700">{{ __('Selamat datang') }}</h1>
                <p class="mt-2 text-gray-500">{{ __('') }}</p>
            </div>

            <div class="w-full px-6 py-8 mt-6 bg-white border border-gray-200 rounded-lg shadow-lg sm:max-w-md">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
