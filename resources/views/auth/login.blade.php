<x-guest-layout>

    <!-- Logo -->
    <div class="flex justify-center mt-6 mb-6">
        <img src="{{ asset('images/custom-logo.png') }}" alt="Logo" class="h-20 w-auto">
    </div>

    <div class="w-full max-w-md mx-auto bg-gray-800 text-white rounded-2xl shadow-lg p-8 space-y-6">
        <h2 class="text-2xl font-semibold text-center">Selamat Datang</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="mb-1 text-white" />
                <x-text-input id="email" class="block w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="mb-1 text-white" />
                <x-text-input id="password" class="block w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="text-blue-500 rounded mr-2">
                    <span class="text-gray-300">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-blue-400 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <x-primary-button class="w-full bg-blue-600 hover:bg-blue-700 transition-colors py-2 px-4 rounded-lg text-white font-semibold">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Register Link -->
        <div class="text-center">
            <p class="text-sm">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="text-blue-400 hover:underline font-medium">Register</a>
            </p>
        </div>
    </div>
</x-guest-layout>
