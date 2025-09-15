<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Krusit</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative flex items-center justify-center min-h-screen font-sans bg-center bg-cover bg-hero-krusit">

    <div class="absolute inset-0 bg-black/60"></div>

    <main class="relative z-10 max-w-3xl px-6 text-center text-white">

        <header class="flex flex-col items-center mb-8">
            <h1 class="text-6xl font-extrabold md:text-8xl" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
                <span class="text-orange-400">KRUSIT</span>
            </h1>
            <p class="mt-4 text-lg text-gray-200 md:text-xl max-w-prose">
                Krupuk Pangsit Goreng Renyah. Nikmati setiap gigitan renyahnya, dibuat dari bahan-bahan pilihan terbaik.
            </p>
        </header>

        <div class="flex flex-col justify-center gap-4 mt-10 md:flex-row">
            <a href="{{ route('register') }}"
               class="px-8 py-3 text-lg font-bold text-gray-900 transition duration-300 transform bg-orange-400 shadow-lg rounded-xl hover:bg-orange-300 hover:scale-105">
                Daftar Sekarang
            </a>
            <a href="{{ route('login') }}"
               class="px-8 py-3 text-lg font-bold text-white transition duration-300 transform border-2 border-orange-400 shadow-lg bg-gray-900/50 rounded-xl backdrop-blur-sm hover:bg-orange-400 hover:text-gray-900 hover:scale-105">
                Masuk
            </a>
        </div>

        <footer class="absolute text-sm text-gray-400 -translate-x-1/2 bottom-6 left-1/2">
            &copy; {{ date('Y') }} Krusit. All rights reserved.
        </footer>
    </main>
</body>
</html>
