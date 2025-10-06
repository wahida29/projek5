<x-guest-layout>
    <!-- Info text -->
    <div class="mb-4 text-sm text-white">
        {{ __('Masukkan email untuk merubah kata sandi anda') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-white" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white font-bold" />
            <x-text-input id="email"
                          class="block w-full mt-1 bg-white text-black placeholder-gray-600 rounded-md shadow-sm border border-gray-300 
                                 focus:border-black focus:ring-2 focus:ring-gray-400"
                          style="color:black !important;"
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required autofocus
                          placeholder="Masukkan email anda"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-white" />
        </div>

        <!-- Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="px-6 py-2 bg-black text-white font-bold rounded-md shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2">
                {{ __('Kirim kode') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
