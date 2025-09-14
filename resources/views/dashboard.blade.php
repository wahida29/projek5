<x-app-layout>

    <div class="relative flex items-center justify-center h-screen bg-center bg-cover" style="background-image: url('/img/krusit2.png');">
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <div class="relative z-10 px-4 text-center text-white">
            <h1 class="text-5xl font-semibold md:text-6xl" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.8);">
                Nikmati Setiap Menu Yang Murah
            </h1>
            <p class="mt-2 text-5xl font-semibold md:text-6xl" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.8);">
                Hanya Di <span class="block mt-4 font-extrabold text-orange-400 text-7xl md:text-8xl">KRUSIT</span>
            </p>
        </div>
    </div>

    <section class="py-16 text-white bg-orange-400">
        <div class="container px-4 mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8 text-center md:grid-cols-4">

                <div class="p-4 transition duration-300 transform hover:scale-110">
                    <h3 class="text-2xl font-bold tracking-wider md:text-3xl">HALAL</h3>
                </div>

                <div class="p-4 transition duration-300 transform hover:scale-110">
                    <h3 class="text-2xl font-bold tracking-wider md:text-3xl">CRISPY</h3>
                </div>

                <div class="p-4 transition duration-300 transform hover:scale-110">
                    <h3 class="text-2xl font-bold tracking-wider md:text-3xl">KRUNCHY</h3>
                </div>

                <div class="p-4 transition duration-300 transform hover:scale-110">
                    <h3 class="text-2xl font-bold tracking-wider md:text-3xl">JUICY</h3>
                </div>

            </div>
        </div>
    </section>

    <footer class="py-8 text-gray-300 bg-gray-900">
        <div class="container px-4 mx-auto text-center">
            <p class="text-base">&copy; 2024 KRUSIT. All rights reserved.</p>
            <div class="flex justify-center mt-4 space-x-6">
                <a href="#" class="transition hover:text-orange-400">Facebook</a>
                <a href="#" class="transition hover:text-orange-400">Instagram</a>
                <a href="#" class="transition hover:text-orange-400">Twitter</a>
            </div>
        </div>
    </footer>

</x-app-layout>
