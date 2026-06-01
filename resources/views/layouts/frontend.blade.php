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
                    @auth
                        <a href="{{ route('riwayat') }}" class="text-gray-600 hover:text-blue-600 transition font-medium">Riwayat</a>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 transition font-medium">
                                <span>{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 border">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Admin Panel</a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Profil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition font-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-medium">Daftar</a>
                    @endauth
                </div>
                <div class="md:hidden flex items-center">
                    <button x-data @click="$refs.mobileMenu.classList.toggle('hidden')" class="text-gray-600 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div x-ref="mobileMenu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('home') }}" class="block py-2 text-gray-600 hover:text-blue-600">Beranda</a>
                <a href="{{ route('catalog') }}" class="block py-2 text-gray-600 hover:text-blue-600">Mobil</a>
                @auth
                    <a href="{{ route('riwayat') }}" class="block py-2 text-gray-600 hover:text-blue-600">Riwayat</a>
                    <hr>
                    <a href="{{ route('profile.edit') }}" class="block py-2 text-gray-600 hover:text-blue-600">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left py-2 text-gray-600 hover:text-blue-600">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block py-2 text-gray-600 hover:text-blue-600">Masuk</a>
                    <a href="{{ route('register') }}" class="block py-2 text-blue-600 font-medium">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('rencar.png') }}" alt="Rencar" class="h-12 w-auto">
                    </div>
                    <p class="text-gray-400 text-sm">Solusi sewa mobil terpercaya untuk perjalanan Anda. Dengan armada lengkap dan harga terbaik.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-4">Layanan</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('catalog') }}" class="hover:text-blue-400 transition">Sewa Mobil</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Sewa Sopir</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Lepas Kunci</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Antar Jemput</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-4">Perusahaan</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-blue-400 transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>0858 3270 0738</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>info@rencar.com</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Jl. Merdeka No. 123, Jakarta</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Rencar. All rights reserved.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
