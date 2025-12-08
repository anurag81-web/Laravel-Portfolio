<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #dbeafe 0%, #ffffff 50%, #e0f2fe 100%);
            background-size: 200% 200%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1.5rem 1rem;
            position: relative;
            z-index: 10;
        }

        /* Floating background circles */
        .auth-container::before,
        .auth-container::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(29, 78, 216, 0.15), rgba(59, 130, 246, 0.08));
            filter: blur(60px);
            animation: float 20s ease-in-out infinite;
            z-index: 1;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -30px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .auth-container::before {
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .auth-container::after {
            bottom: -100px;
            right: -100px;
            animation-delay: -10s;
        }

        .logo-wrapper {
            margin-bottom: 2rem;
            animation: fadeInDown 0.8s ease-out;
            position: relative;
            z-index: 10;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-wrapper a {
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .logo-wrapper a:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .auth-card {
            width: 100%;
            max-width: 28rem;
            margin-top: 1.5rem;
            padding: 2.5rem 2rem;
            background: rgba(255, 255, 255, 0.9);
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(29, 78, 216, 0.1);
            box-shadow: 0 10px 40px rgba(29, 78, 216, 0.15), 0 0 30px rgba(29, 78, 216, 0.08);
            border-radius: 20px;
            overflow: hidden;
            animation: fadeInScale 1s ease-out;
            position: relative;
            z-index: 10;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .auth-card:hover {
            box-shadow: 0 15px 50px rgba(29, 78, 216, 0.2), 0 0 40px rgba(29, 78, 216, 0.12);
            border-color: rgba(29, 78, 216, 0.2);
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="logo-wrapper">
            <a href="/">
                <x-application-logo style="width: 5rem; height: 5rem; fill: url(#logo-gradient);" />
                <svg width="0" height="0">
                    <defs>
                        <linearGradient id="logo-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#1d4ed8;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#3b82f6;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                </svg>
            </a>
        </div>

        <div class="auth-card">
            {{ $slot }}
        </div>
    </div>
</body>

</html>