<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krusit</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 min-h-screen flex items-center justify-center">
    <div class="max-w-3xl text-center text-white px-6">
        <!-- Logo / Brand -->
        <div class="mb-8">
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight drop-shadow-lg">
                Krusit
            </h1>
            <p class="mt-4 text-lg md:text-xl opacity-90">
                Solusi kreatif untuk berbagi ide dan inovasi digital.
            </p>
        </div>

        <!-- CTA Buttons -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-4 mt-8">
            <a href="{{ route('register') }}"
               class="px-6 py-3 bg-white text-indigo-700 font-semibold rounded-2xl shadow hover:bg-indigo-100 transition">
               Daftar Sekarang
            </a>
            <a href="{{ route('login') }}"
               class="px-6 py-3 bg-indigo-800/50 border border-white/30 text-white font-semibold rounded-2xl hover:bg-indigo-700 transition">
               Masuk
            </a>
        </div>

        <!-- Footer -->
        <p class="mt-12 text-sm text-white/80">
            &copy; {{ date('Y') }} Krusit. All rights reserved.
        </p>
    </div>
</body>
</html>
