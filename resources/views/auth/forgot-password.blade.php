<x-guest-layout>
    <div
        style="margin-bottom: 1.5rem; font-size: 0.95rem; color: #1b2a4e; line-height: 1.6; font-family: 'Poppins', sans-serif; text-align: center;">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div style="margin-bottom: 1.5rem;">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div style="margin-top: 1.5rem;">
            <x-primary-button style="width: 100%;">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>

        <!-- Back to Login Link -->
        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="{{ route('login') }}"
                style="font-size: 0.9rem; color: #1d4ed8; text-decoration: none; font-weight: 600; transition: all 0.3s ease; font-family: 'Poppins', sans-serif;"
                onmouseover="this.style.color='#3b82f6'; this.style.textDecoration='underline';"
                onmouseout="this.style.color='#1d4ed8'; this.style.textDecoration='none';">
                ← Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>