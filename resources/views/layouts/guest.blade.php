<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Rencar')) - Rencar</title>
    <link rel="icon" type="image/png" href="{{ asset('rencar.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased text-gray-800">
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('rencar.png') }}" alt="Rencar" class="h-14 w-auto">
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition font-medium">Beranda</a>
                    <a href="{{ route('catalog') }}" class="text-gray-600 hover:text-blue-600 transition font-medium">Mobil</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen flex items-center justify-center bg-gray-100 pt-16">
        <div class="w-full max-w-md px-4 py-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                {{ $slot }}
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <img src="{{ asset('rencar.png') }}" alt="Rencar" class="h-12 w-auto">
                </div>
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Rencar. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
