<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Krusit - Krupuk Pangsit Renyah</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative flex items-center justify-center min-h-screen font-sans bg-center bg-cover bg-hero-krusit">

    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/60 to-transparent"></div>

    <main class="relative z-10 flex flex-col items-center justify-center min-h-screen px-6 text-center text-white">

        <div class="animate-fade-in-up">
            <header class="flex flex-col items-center mb-8">
                <div class="w-20 h-20 mb-4 text-orange-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full drop-shadow-lg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.362-3.797z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214C14.24 4.022 13.014 3 12 3c-1.014 0-2.24.022-3.362 2.214" />
                    </svg>
                </div>

                <h1 class="text-6xl font-extrabold tracking-tight md:text-8xl" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
                    <span class="text-white">KRUSIT</span>
                </h1>
                <p class="mt-4 text-lg text-gray-300 md:text-xl max-w-prose">
                    Krupuk Pangsit Goreng Renyah. Nikmati setiap gigitan renyahnya, dibuat dari bahan-bahan pilihan terbaik.
                </p>
            </header>

            <div class="flex flex-col justify-center gap-4 mt-10 md:flex-row">
                <a href="{{ route('register') }}"
                   class="px-8 py-3 text-lg font-bold text-gray-900 transition duration-300 transform bg-orange-400 border-2 border-orange-400 shadow-lg rounded-xl hover:bg-orange-300 hover:scale-105">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}"
                   class="px-8 py-3 text-lg font-bold text-white transition duration-300 transform bg-transparent border-2 border-white shadow-lg rounded-xl backdrop-blur-sm hover:bg-white hover:text-gray-900 hover:scale-105">
                    Masuk
                </a>
            </div>
        </div>
    </main>
</body>
</html>
