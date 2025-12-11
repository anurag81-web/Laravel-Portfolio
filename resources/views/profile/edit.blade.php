<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-dark leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="pb-12 px-4 max-w-6xl mx-auto space-y-8">
        <div class="p-8 bg-white rounded-3xl shadow-card border border-black/5 relative overflow-hidden">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-8 bg-white rounded-3xl shadow-card border border-black/5 relative overflow-hidden">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-8 bg-white rounded-3xl shadow-card border border-black/5 relative overflow-hidden">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>