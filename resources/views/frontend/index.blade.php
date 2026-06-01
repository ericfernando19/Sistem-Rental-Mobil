@extends('layouts.frontend')

@section('title', 'Beranda')

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-blue-600 text-white pt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl lg:text-6xl font-bold leading-tight mb-6">
                        Sewa Mobil <span class="text-yellow-400">Terpercaya</span> untuk Perjalanan Anda
                    </h1>
                    <p class="text-lg lg:text-xl text-blue-200 mb-8">
                        Nikmati kemudahan sewa mobil dengan armada lengkap, harga terjangkau, dan pelayanan terbaik. Siap menemani perjalanan bisnis maupun liburan Anda.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('catalog') }}" class="bg-yellow-400 text-blue-900 px-8 py-3 rounded-lg font-semibold hover:bg-yellow-300 transition transform hover:scale-105">
                            Lihat Katalog Mobil
                        </a>
                        <a href="#layanan" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-900 transition">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block relative">
                    <div class="relative z-10">
                        <svg class="w-full h-auto" viewBox="0 0 600 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="50" y="100" width="500" height="200" rx="20" fill="#1E40AF" class="opacity-50"/>
                            <rect x="80" y="130" width="440" height="140" rx="15" fill="#1E3A8A" class="opacity-70"/>
                            <circle cx="180" cy="300" r="40" fill="#1E3A8A"/>
                            <circle cx="420" cy="300" r="40" fill="#1E3A8A"/>
                            <circle cx="180" cy="300" r="20" fill="#1E40AF"/>
                            <circle cx="420" cy="300" r="20" fill="#1E40AF"/>
                            <rect x="100" y="160" width="400" height="80" rx="10" fill="#2563EB"/>
                            <rect x="120" y="175" width="150" height="12" rx="6" fill="#60A5FA"/>
                            <rect x="120" y="195" width="200" height="8" rx="4" fill="#93C5FD"/>
                            <rect x="120" y="210" width="180" height="8" rx="4" fill="#93C5FD"/>
                            <rect x="350" y="175" width="120" height="40" rx="8" fill="#FACC15"/>
                            <rect x="120" y="175" width="150" height="12" rx="6" fill="#60A5FA" opacity="0.5"/>
                        </svg>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-48 h-48 bg-yellow-400 rounded-full opacity-20 blur-3xl"></div>
                    <div class="absolute -top-4 -left-4 w-64 h-64 bg-blue-300 rounded-full opacity-20 blur-3xl"></div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 100L1440 0V100H0Z" fill="#F3F4F6"/>
            </svg>
        </div>
    </section>

    {{-- Stats --}}
    <section class="bg-white py-12 -mt-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600">{{ $totalCars }}</div>
                    <div class="text-gray-500 mt-1">Total Mobil</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600">{{ $totalCustomers }}</div>
                    <div class="text-gray-500 mt-1">Pelanggan</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600">{{ $totalBookings }}</div>
                    <div class="text-gray-500 mt-1">Transaksi</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600">{{ $totalCars * 5 }}</div>
                    <div class="text-gray-500 mt-1">Tujuan Wisata</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Cars --}}
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Mobil Unggulan</h2>
                <p class="text-gray-500 mt-3">Pilihan mobil terbaik untuk perjalanan Anda</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($cars as $car)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition group">
                        <div class="relative h-48 bg-gray-200 overflow-hidden">
                            @if($car->main_image)
                                <img src="{{ asset('storage/' . $car->main_image) }}" alt="{{ $car->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-400 to-blue-600">
                                    <svg class="w-16 h-16 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-3 right-3">
                                @if($car->status === 'available')
                                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">Tersedia</span>
                                @else
                                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">Tidak Tersedia</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $car->name }}</h3>
                            <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                                <span class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>{{ $car->transmission === 'manual' ? 'Manual' : 'Matic' }}</span>
                                </span>
                                <span class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span>{{ $car->passenger_capacity }} kursi</span>
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</span>
                                    <span class="text-sm text-gray-500">/hari</span>
                                </div>
                                <a href="{{ route('detail', $car) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">Belum ada mobil tersedia.</div>
                @endforelse
            </div>
            @if($cars->count() > 0)
                <div class="text-center mt-8">
                    <a href="{{ route('catalog') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Lihat Semua Mobil</a>
                </div>
            @endif
        </div>
    </section>

    {{-- Services --}}
    <section id="layanan" class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Keunggulan Layanan</h2>
                <p class="text-gray-500 mt-3">Mengapa memilih RentalMobil?</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 rounded-xl hover:bg-gray-50 transition">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Terpercaya & Aman</h3>
                    <p class="text-gray-500">Armada terawat dengan asuransi komprehensif untuk kenyamanan perjalanan Anda.</p>
                </div>
                <div class="text-center p-8 rounded-xl hover:bg-gray-50 transition">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Proses Cepat</h3>
                    <p class="text-gray-500">Booking online mudah dan cepat. Proses sewa dalam hitungan menit.</p>
                </div>
                <div class="text-center p-8 rounded-xl hover:bg-gray-50 transition">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Antar Jemput</h3>
                    <p class="text-gray-500">Layanan antar jemput mobil di lokasi yang Anda inginkan.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Testimoni Pelanggan</h2>
                <p class="text-gray-500 mt-3">Apa kata mereka tentang layanan kami</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center space-x-1 text-yellow-400 mb-4">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-gray-600 mb-4">"Pelayanan sangat memuaskan! Mobil bersih, proses cepat, dan harga terjangkau. Pasti akan sewa lagi di sini."</p>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center text-blue-600 font-bold">A</div>
                        <div>
                            <p class="font-medium text-gray-800">Andi Pratama</p>
                            <p class="text-sm text-gray-500">Pelanggan Setia</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center space-x-1 text-yellow-400 mb-4">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-gray-600 mb-4">"Mobil yang disediakan berkualitas dan terawat. Pelayanan sopir juga ramah dan profesional. Sangat recommended!"</p>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-200 rounded-full flex items-center justify-center text-green-600 font-bold">S</div>
                        <div>
                            <p class="font-medium text-gray-800">Siti Rahmawati</p>
                            <p class="text-sm text-gray-500">Wisatawan</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center space-x-1 text-yellow-400 mb-4">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-gray-600 mb-4">"Proses booking mudah dan cepat. Harga transparan tanpa biaya tersembunyi. Layanan pelanggan sangat responsif."</p>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-200 rounded-full flex items-center justify-center text-purple-600 font-bold">B</div>
                        <div>
                            <p class="font-medium text-gray-800">Budi Santoso</p>
                            <p class="text-sm text-gray-500">Pebisnis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="bg-white py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">FAQ</h2>
                <p class="text-gray-500 mt-3">Pertanyaan yang sering diajukan</p>
            </div>
            <div class="space-y-4" x-data="{ active: null }">
                <div class="border border-gray-200 rounded-lg overflow-hidden" :class="{'shadow-md': active === 1}">
                    <button @click="active = active === 1 ? null : 1" class="w-full flex justify-between items-center p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                        <span class="font-medium text-gray-800">Bagaimana cara booking mobil?</span>
                        <svg class="w-5 h-5 text-gray-500 transition" :class="{'rotate-180': active === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 1" x-collapse class="p-4 text-gray-600 border-t border-gray-200">
                        Anda dapat booking mobil melalui website dengan memilih mobil yang diinginkan, mengisi form booking, dan melakukan konfirmasi. Setelah itu, tim kami akan menghubungi Anda untuk verifikasi.
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg overflow-hidden" :class="{'shadow-md': active === 2}">
                    <button @click="active = active === 2 ? null : 2" class="w-full flex justify-between items-center p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                        <span class="font-medium text-gray-800">Apa saja persyaratan sewa mobil?</span>
                        <svg class="w-5 h-5 text-gray-500 transition" :class="{'rotate-180': active === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 2" x-collapse class="p-4 text-gray-600 border-t border-gray-200">
                        Persyaratan utama: KTP asli, SIM A/B1 yang masih berlaku, dan jaminan (deposit atau BPKB) sesuai kebijakan perusahaan.
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg overflow-hidden" :class="{'shadow-md': active === 3}">
                    <button @click="active = active === 3 ? null : 3" class="w-full flex justify-between items-center p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                        <span class="font-medium text-gray-800">Apakah bisa antar jemput mobil?</span>
                        <svg class="w-5 h-5 text-gray-500 transition" :class="{'rotate-180': active === 3}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 3" x-collapse class="p-4 text-gray-600 border-t border-gray-200">
                        Ya, kami menyediakan layanan antar jemput mobil ke lokasi Anda. Anda dapat memilih opsi ini saat melakukan booking.
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg overflow-hidden" :class="{'shadow-md': active === 4}">
                    <button @click="active = active === 4 ? null : 4" class="w-full flex justify-between items-center p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                        <span class="font-medium text-gray-800">Bagaimana jika terjadi kecelakaan?</span>
                        <svg class="w-5 h-5 text-gray-500 transition" :class="{'rotate-180': active === 4}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 4" x-collapse class="p-4 text-gray-600 border-t border-gray-200">
                        Setiap mobil sudah dilengkapi asuransi komprehensif. Jika terjadi kecelakaan, segera hubungi tim kami untuk bantuan dan proses klaim asuransi.
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg overflow-hidden" :class="{'shadow-md': active === 5}">
                    <button @click="active = active === 5 ? null : 5" class="w-full flex justify-between items-center p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                        <span class="font-medium text-gray-800">Apakah bisa membatalkan booking?</span>
                        <svg class="w-5 h-5 text-gray-500 transition" :class="{'rotate-180': active === 5}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 5" x-collapse class="p-4 text-gray-600 border-t border-gray-200">
                        Pembatalan dapat dilakukan dengan menghubungi tim kami. Kebijakan pembatalan dan refund mengikuti syarat & ketentuan yang berlaku.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
