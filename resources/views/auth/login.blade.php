<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox"
                    class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary/20 accent-primary"
                    name="remember">
                <span
                    class="ml-2 text-sm text-gray-600 group-hover:text-primary transition-colors">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-primary hover:text-primary-dark transition-colors"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <x-primary-button class="w-full">
            {{ __('Log in') }}
        </x-primary-button>

        <!-- Register Link -->
        <div class="text-center mt-6">
            <span class="text-sm text-gray-600">Don't have an account?</span>
            <a href="{{ route('register') }}"
                class="text-sm font-bold text-primary hover:text-primary-dark ml-1 transition-colors">
                Register here
            </a>
        </div>
    </form>
</x-guest-layout>