<footer class="text-gray-300 bg-gray-900">
    <div class="container px-4 py-8 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
        <h3 class="text-2xl font-semibold text-white">Coffe Gallery</h3>
        <p class="max-w-md mx-auto mt-2 text-sm">
            Perpaduan Aroma,Rasa dan Cerita dalam Secangkir Coffe.
        </p>
        <p class="mt-6 space-x-6">
            <a href="{{ url('/register') }}" class="font-medium text-orange-400 transition hover:text-orange-300">Daftar Sekarang</a>
            <span class="text-gray-600">|</span>
            <a href="{{ url('/login') }}" class="font-medium text-orange-400 transition hover:text-orange-300">Masuk</a>
        </p>
        <p class="mt-6 text-xs text-gray-500">&copy; {{ date('Y') }} caffee Gallery. All rights reserved.</p>
    </div>
</footer>
