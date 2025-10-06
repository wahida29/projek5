<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-semibold text-white">{{ __('Silahkan isi Form') }}</h2>
        <p class="mt-2 text-white">{{ __('') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-white" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
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
                          required autofocus autocomplete="username" 
                          placeholder="Masukkan email anda"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-white" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" class="text-white font-bold" />
            <x-text-input id="password"
                          class="block w-full mt-1 bg-white text-black placeholder-gray-600 rounded-md shadow-sm border border-gray-300 
                                 focus:border-black focus:ring-2 focus:ring-gray-400"
                          style="color:black !important;"
                          type="password" 
                          name="password" 
                          required autocomplete="current-password" 
                          placeholder="Masukkan kata sandi"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-white" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" 
                       class="text-black border-gray-300 rounded shadow-sm focus:ring-black" 
                       name="remember">
                <span class="ml-2 text-sm text-white">{{ __('Ingat Saya') }}</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-white underline hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200"
                   href="{{ route('password.request') }}">
                    {{ __('Lupa Kata Sandi ?') }}
                </a>
            @endif

            <x-primary-button class="px-6 py-2 ml-3 bg-black text-white font-bold rounded-md shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
