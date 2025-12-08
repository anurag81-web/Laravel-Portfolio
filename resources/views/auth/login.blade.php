<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div style="margin-bottom: 1.25rem;">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 1.25rem;">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div style="margin-bottom: 1.5rem;">
            <label for="remember_me" style="display: inline-flex; align-items: center; cursor: pointer;">
                <input id="remember_me" type="checkbox" name="remember"
                    style="width: 18px; height: 18px; border-radius: 6px; border: 2px solid #1d4ed8; cursor: pointer; accent-color: #1d4ed8;">
                <span
                    style="margin-left: 0.75rem; font-size: 0.95rem; color: #1b2a4e; font-family: 'Poppins', sans-serif;">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Forgot Password Link -->
        @if (Route::has('password.request'))
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <a href="{{ route('password.request') }}"
                    style="font-size: 0.9rem; color: #1d4ed8; text-decoration: none; font-weight: 600; transition: all 0.3s ease; font-family: 'Poppins', sans-serif;"
                    onmouseover="this.style.color='#3b82f6'; this.style.textDecoration='underline';"
                    onmouseout="this.style.color='#1d4ed8'; this.style.textDecoration='none';">
                    {{ __('Forgot your password?') }}
                </a>
            </div>
        @endif

        <!-- Submit Button -->
        <div style="margin-top: 1.5rem;">
            <x-primary-button style="width: 100%;">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div style="text-align: center; margin-top: 1.5rem;">
            <span style="font-size: 0.9rem; color: #1b2a4e; font-family: 'Poppins', sans-serif;">Don't have an account?
            </span>
            <a href="{{ route('register') }}"
                style="font-size: 0.9rem; color: #1d4ed8; text-decoration: none; font-weight: 700; transition: all 0.3s ease; font-family: 'Poppins', sans-serif;"
                onmouseover="this.style.color='#3b82f6'; this.style.textDecoration='underline';"
                onmouseout="this.style.color='#1d4ed8'; this.style.textDecoration='none';">
                Register here
            </a>
        </div>
    </form>
</x-guest-layout>