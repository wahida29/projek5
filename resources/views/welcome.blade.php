```html
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Coffee Gallery - Nikmati Kopi Terbaik</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative flex items-center justify-center min-h-screen font-sans bg-center bg-cover bg-hero-coffee">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/60 to-transparent"></div>

    <main class="relative z-10 flex flex-col items-center justify-center min-h-screen px-6 text-center text-white">

        <div class="animate-fade-in-up">
            <header class="flex flex-col items-center mb-8">
                <!-- Logo Coffee Gallery -->
                <div class="w-24 h-24 mb-4">
                    <img src="{{ asset('images/logo_kopi.jpg') }}" alt="Logo Coffee Gallery" class="w-full h-full object-contain drop-shadow-lg">
                </div>

                <h1 class="text-6xl font-extrabold tracking-tight md:text-8xl" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
                    <span class="text-white">COFFEE GALLERY</span>
                </h1>
                <p class="mt-4 text-lg text-gray-300 md:text-xl max-w-prose">
                    Sajian kopi hangat dari biji pilihan terbaik. Rasakan aroma dan kenikmatan kopi yang membuat harimu lebih bersemangat.
                </p>
            </header>

            <!-- Tombol Aksi -->
            <div class="flex flex-col justify-center gap-4 mt-10 md:flex-row">
                <a href="{{ route('register') }}"
                   class="px-8 py-3 text-lg font-bold text-gray-900 transition duration-300 transform bg-yellow-500 border-2 border-yellow-500 shadow-lg rounded-xl hover:bg-yellow-400 hover:scale-105">
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
```
