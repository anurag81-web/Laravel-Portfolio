<x-app-layout>
    <x-slot name="header">
        <h2
            style="font-size: 1.875rem; font-weight: 700; background: linear-gradient(135deg, #1d4ed8, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div style="padding: 3rem 1rem;">
        <div style="max-width: 56rem; margin: 0 auto; display: flex; flex-direction: column; gap: 1.5rem;">
            <div
                style="padding: 2rem; background: rgba(255, 255, 255, 0.9); -webkit-backdrop-filter: blur(10px); backdrop-filter: blur(10px); box-shadow: 0 10px 30px rgba(29, 78, 216, 0.12); border-radius: 20px; border: 1px solid rgba(29, 78, 216, 0.1);">
                <div style="max-width: 36rem;">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div
                style="padding: 2rem; background: rgba(255, 255, 255, 0.9); -webkit-backdrop-filter: blur(10px); backdrop-filter: blur(10px); box-shadow: 0 10px 30px rgba(29, 78, 216, 0.12); border-radius: 20px; border: 1px solid rgba(29, 78, 216, 0.1);">
                <div style="max-width: 36rem;">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div
                style="padding: 2rem; background: rgba(255, 255, 255, 0.9); -webkit-backdrop-filter: blur(10px); backdrop-filter: blur(10px); box-shadow: 0 10px 30px rgba(29, 78, 216, 0.12); border-radius: 20px; border: 1px solid rgba(29, 78, 216, 0.1);">
                <div style="max-width: 36rem;">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>