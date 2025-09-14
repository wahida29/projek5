<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krusit</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-yellow-400 via-amber-400 to-orange-500 min-h-screen flex items-center justify-center">
    <div class="max-w-3xl text-center text-gray-900 px-6">
        <!-- Logo / Brand -->
        <div class="mb-8 flex flex-col items-center">
            <!-- Simple SVG Logo -->
            <div class="w-20 h-20 mb-4">
                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="32" cy="32" r="30" fill="#facc15" stroke="#f59e0b" stroke-width="4"/>
                    <path d="M20 32l8 8 16-16" stroke="#1f2937" stroke-width="5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight drop-shadow-lg text-gray-900">
                Krusit
            </h1>
            <p class="mt-4 text-lg md:text-xl text-gray-800 opacity-90">
                Solusi kreatif untuk berbagi ide dan inovasi digital.
            </p>
        </div>

        <!-- CTA Buttons -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-4 mt-8">
            <a href="{{ route('register') }}"
               class="px-6 py-3 bg-gray-900 text-yellow-300 font-semibold rounded-2xl shadow hover:bg-gray-800 transition">
               Daftar Sekarang
            </a>
            <a href="{{ route('login') }}"
               class="px-6 py-3 bg-yellow-200/40 border border-gray-800 text-gray-900 font-semibold rounded-2xl hover:bg-yellow-300/60 transition">
               Masuk
            </a>
        </div>

        <!-- Footer -->
        <p class="mt-12 text-sm text-gray-800/80">
            &copy; {{ date('Y') }} Krusit. All rights reserved.
        </p>
    </div>
</body>
</html>
