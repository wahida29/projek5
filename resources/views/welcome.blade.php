<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krusit</title>
    @vite('resources/css/app.css')
</head>
<body class="relative min-h-screen flex items-center justify-center bg-cover bg-center" 
      style="background-image: url('{{ asset('img/krusit2.png') }}');">

    <!-- Overlay agar teks kontras -->
    <div class="absolute inset-0 bg-yellow-500/40 backdrop-blur-sm"></div>

    <div class="relative z-10 max-w-3xl text-center px-6 text-gray-900">
        <!-- Logo -->
        <div class="flex flex-col items-center mb-8">
            <div class="w-24 h-24 mb-4">
                <!-- Gunakan komponen logo Breeze -->
                <x-application-logo class="w-24 h-24 fill-current text-gray-900" />
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold drop-shadow-lg">
                Krusit
            </h1>
            <p class="mt-4 text-lg md:text-xl text-gray-800">
                Solusi kreatif untuk berbagi ide dan inovasi digital.
            </p>
        </div>

        <!-- CTA Buttons -->
        <div class="flex flex-col md:flex-row justify-center gap-4 mt-8">
            <a href="{{ route('register') }}"
               class="px-6 py-3 bg-gray-900 text-yellow-300 font-semibold rounded-2xl shadow hover:bg-gray-800 transition">
               Daftar Sekarang
            </a>
            <a href="{{ route('login') }}"
               class="px-6 py-3 bg-yellow-300/70 border border-gray-900 text-gray-900 font-semibold rounded-2xl hover:bg-yellow-300 transition">
               Masuk
            </a>
        </div>

        <!-- Footer -->
        <p class="mt-12 text-sm text-gray-800/90">
            &copy; {{ date('Y') }} Krusit. All rights reserved.
        </p>
    </div>
</body>
</html>
