<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div style="margin-bottom: 1.25rem;">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div style="margin-bottom: 1.25rem;">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 1.25rem;">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div style="margin-bottom: 1.25rem;">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div style="margin-top: 1.5rem;">
            <x-primary-button style="width: 100%;">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <!-- Login Link -->
        <div style="text-align: center; margin-top: 1.5rem;">
            <span style="font-size: 0.9rem; color: #1b2a4e; font-family: 'Poppins', sans-serif;">Already have an
                account? </span>
            <a href="{{ route('login') }}"
                style="font-size: 0.9rem; color: #1d4ed8; text-decoration: none; font-weight: 700; transition: all 0.3s ease; font-family: 'Poppins', sans-serif;"
                onmouseover="this.style.color='#3b82f6'; this.style.textDecoration='underline';"
                onmouseout="this.style.color='#1d4ed8'; this.style.textDecoration='none';">
                Login here
            </a>
        </div>
    </form>
</x-guest-layout>