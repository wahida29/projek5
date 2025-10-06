<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" class="text-white font-bold" />
            <x-text-input id="name" 
                          class="block w-full mt-1 bg-white rounded-lg border border-gray-300 focus:border-black focus:ring-2 focus:ring-gray-400" 
                          style="color: black;" 
                          type="text" 
                          name="name" 
                          :value="old('name')" 
                          required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-white" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-white font-bold" />
            <x-text-input id="email" 
                          class="block w-full mt-1 bg-white rounded-lg border border-gray-300 focus:border-black focus:ring-2 focus:ring-gray-400" 
                          style="color: black;" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-white" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" class="text-white font-bold" />
            <x-text-input id="password" 
                          class="block w-full mt-1 bg-white rounded-lg border border-gray-300 focus:border-black focus:ring-2 focus:ring-gray-400" 
                          style="color: black;" 
                          type="password" 
                          name="password" 
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-white" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Masukkan Ulang Kata Sandi')" class="text-white font-bold" />
            <x-text-input id="password_confirmation" 
                          class="block w-full mt-1 bg-white rounded-lg border border-gray-300 focus:border-black focus:ring-2 focus:ring-gray-400" 
                          style="color: black;" 
                          type="password" 
                          name="password_confirmation" 
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-white" />
        </div>

        <!-- Link & Button -->
        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-white font-bold underline hover:text-gray-300" href="{{ route('login') }}">
                {{ __('Sudah Daftar ?') }}
            </a>

            <x-primary-button class="bg-black text-white font-bold px-6 py-2 rounded-lg hover:bg-gray-800">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
