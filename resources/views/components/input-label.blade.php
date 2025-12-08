@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm mb-2']) }}
    style="color: #1b2a4e; font-family: 'Poppins', sans-serif; font-weight: 600;">
    {{ $value ?? $slot }}
</label>