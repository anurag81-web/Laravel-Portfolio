<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-light">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-light relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0 opacity-30">
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-primary/20 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2">
            </div>
            <div
                class="absolute bottom-0 left-0 w-96 h-96 bg-secondary/20 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2">
            </div>
        </div>

        <div
            class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-card rounded-3xl border border-white/50 backdrop-blur-sm">
            <div class="flex flex-col items-center mb-6">
                <!-- Logo Removed -->
                <h2 class="mt-4 text-2xl font-bold text-dark">Welcome Back</h2>
                <p class="text-sm text-gray-500">Please enter your details to sign in.</p>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>

</html>