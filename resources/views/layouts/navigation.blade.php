<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 bg-gray-800/90 backdrop-blur-md border-b border-gray-700">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                {{-- Logo --}}
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block w-auto text-gray-200 fill-current h-9" />
                    </a>
                </div>

                {{-- Menu Links --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <div class="flex items-center">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-300 transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:text-white focus:outline-none">
                                    Menu Varian
                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('kopi')">{{ __('Coffee') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('nonkopi')">{{ __('Non Coffee') }}</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <x-nav-link :href="route('kontak')" :active="request()->routeIs('kontak')">
                        {{ __('Kontak') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pesanan.index')" :active="request()->routeIs('pesanan.index')">
                        {{ __('Lihat Pesanan') }}
                    </x-nav-link>

                    {{-- Menu Admin --}}
                    @if (Auth::check() && Auth::user()->role === 'admin')
                        <x-nav-link :href="route('barang.create')" :active="request()->routeIs('barang.create')">
                            {{ __('Tambah Menu') }}
                        </x-nav-link>
                        <x-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.index')">
                            {{ __('Edit Menu') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- Dropdown User --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-300 transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:text-white focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger Menu (Mobile) --}}
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
