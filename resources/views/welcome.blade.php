<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krusit</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative flex items-center justify-center min-h-screen bg-center bg-cover"
      style="background-image: url('{{ asset('img/krusit2.png') }}');">

    <!-- Overlay agar teks lebih kontras -->
    <div class="absolute inset-0 bg-yellow-500/40 backdrop-blur-sm"></div>

    <!-- Konten utama -->
    <main class="relative z-10 max-w-3xl px-6 text-center text-gray-900">
        <!-- Logo & Judul -->
        <header class="flex flex-col items-center mb-8">
            <div class="w-24 h-24 mb-4">
                <x-application-logo class="w-24 h-24 text-gray-900 fill-current" />
            </div>
            <h1 class="text-5xl font-extrabold md:text-6xl drop-shadow-lg">
                Krusit
            </h1>
            <p class="mt-4 text-lg text-gray-800 md:text-xl">
                Solusi kreatif untuk berbagi ide dan inovasi digital.
            </p>
        </header>

        <!-- Tombol CTA -->
        <div class="flex flex-col justify-center gap-4 mt-8 md:flex-row">
            <a href="{{ route('register') }}"
               class="px-6 py-3 font-semibold text-yellow-300 transition duration-300 bg-gray-900 shadow rounded-2xl hover:bg-gray-800">
               Daftar Sekarang
            </a>
            <a href="{{ route('login') }}"
               class="px-6 py-3 font-semibold text-gray-900 transition duration-300 border border-gray-900 bg-yellow-300/70 rounded-2xl hover:bg-yellow-300">
               Masuk
            </a>
        </div>

        <!-- Footer -->
        <footer class="mt-12 text-sm text-gray-800/90">
            &copy; {{ date('Y') }} Krusit. All rights reserved.
        </footer>
    </main>
</body>
</html>
