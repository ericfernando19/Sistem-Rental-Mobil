<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Rencar</title>
    <link rel="icon" type="image/png" href="{{ asset('rencar.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-0 z-40 flex md:static md:translate-x-0 transition-transform duration-300 ease-in-out">
            <div @click="sidebarOpen = false" class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm md:hidden"></div>
            <aside class="relative flex flex-col w-64 bg-gradient-to-b from-slate-800 to-slate-900 text-white">
                <div class="flex items-center justify-between px-5 py-5 border-b border-white/[0.08]">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2.5">
                        <img src="{{ asset('rencar.png') }}" alt="Rencar" class="h-9 w-auto rounded-lg bg-white p-1">
                        <span class="text-base font-semibold tracking-tight">Rencar Admin</span>
                    </a>
                    <button @click="sidebarOpen = false" class="md:hidden text-white/40 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-white/[0.1] text-white shadow-sm' : 'text-slate-300 hover:bg-white/[0.06] hover:text-white' }} transition-all duration-200">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.cars.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.cars.*') ? 'bg-white/[0.1] text-white shadow-sm' : 'text-slate-300 hover:bg-white/[0.06] hover:text-white' }} transition-all duration-200">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span>Mobil</span>
                    </a>
                    <a href="{{ route('admin.bookings.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.bookings.*') ? 'bg-white/[0.1] text-white shadow-sm' : 'text-slate-300 hover:bg-white/[0.06] hover:text-white' }} transition-all duration-200">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Booking</span>
                    </a>
                    <a href="{{ route('admin.customers.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.customers.*') ? 'bg-white/[0.1] text-white shadow-sm' : 'text-slate-300 hover:bg-white/[0.06] hover:text-white' }} transition-all duration-200">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                        <span>Pelanggan</span>
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.reports.*') ? 'bg-white/[0.1] text-white shadow-sm' : 'text-slate-300 hover:bg-white/[0.06] hover:text-white' }} transition-all duration-200">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        <span>Laporan</span>
                    </a>
                </nav>

                <div class="border-t border-white/[0.08] px-4 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-semibold ring-2 ring-white/10">{{ substr(auth()->user()->name, 0, 1) }}</div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                            <p class="text-[11px] text-slate-400 truncate">Administrator</p>
                        </div>
                    </div>
                    <a href="{{ route('home') }}" class="mt-3 flex items-center space-x-2 text-xs text-slate-400 hover:text-white transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Kembali ke Website</span>
                    </a>
                </div>
            </aside>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white/80 backdrop-blur-md border-b border-gray-200/60">
                <div class="flex items-center justify-between px-6 py-3.5">
                    <div class="flex items-center space-x-3">
                        <button @click="sidebarOpen = true" class="md:hidden text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <h2 class="text-sm font-semibold text-gray-800">@yield('header', 'Dashboard')</h2>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('profile.edit') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">Profil</a>
                        <div class="w-px h-4 bg-gray-200"></div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-gray-500 hover:text-red-500 transition">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="mb-5 bg-emerald-50 border border-emerald-200/60 text-emerald-700 px-4 py-3 rounded-xl text-sm flex items-center justify-between" x-data="{ show: true }" x-show="show" x-transition>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="ml-4 text-emerald-500 hover:text-emerald-700 shrink-0">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </button>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
