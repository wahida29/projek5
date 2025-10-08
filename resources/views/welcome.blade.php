<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Gallery - Nikmati Kopi Terbaik</title>

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS custom -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <!-- Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Background full foto */
        .bg-hero-coffee {
            background-image: url('{{ asset('img/biji.jpg') }}'); /* Pastikan letak file benar: public/img/biji.jpg */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="relative flex items-center justify-center min-h-screen font-sans bg-hero-coffee">

    <!-- Overlay Gelap supaya teks jelas -->
    <div class="absolute inset-0 bg-black/70"></div>

    <!-- Konten Utama -->
    <main class="relative z-10 flex flex-col items-center justify-center px-6 text-center text-white">
        <header class="flex flex-col items-center mb-8 animate-fade-in-up">

            <!-- Logo -->
            <div class="mb-6">
                <img src="{{ asset('img/logo_kopi.jpg') }}" 
                     alt="Logo Coffee Gallery" 
                     class="w-28 md:w-40 lg:w-52 h-auto mx-auto object-contain drop-shadow-lg rounded-full bg-white/90 p-2">
            </div>

            <!-- Judul -->
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight drop-shadow-lg">
                COFFEE GALLERY
            </h1>

            <!-- Deskripsi -->
            <p class="mt-4 text-base md:text-lg lg:text-xl max-w-2xl text-gray-200 drop-shadow-md">
                Sajian kopi hangat dari biji pilihan terbaik. Rasakan aroma dan kenikmatan kopi yang membuat harimu lebih bersemangat.
            </p>
        </header>

        <!-- Tombol Aksi -->
        <div class="flex flex-col md:flex-row gap-4 mt-10">
            <a href="{{ route('register') }}"
               class="px-8 py-3 text-lg font-bold text-gray-900 bg-yellow-500 border-2 border-yellow-500 rounded-xl shadow-lg transition duration-300 transform hover:bg-yellow-400 hover:scale-105">
                Daftar Sekarang
            </a>

            <a href="{{ route('login') }}"
               class="px-8 py-3 text-lg font-bold text-white bg-transparent border-2 border-white rounded-xl shadow-lg backdrop-blur-sm transition duration-300 transform hover:bg-white hover:text-gray-900 hover:scale-105">
                Masuk
            </a>
        </div>
    </main>

</body>
</html>
