@extends('layouts.frontend')

@section('title', $car->name)

@section('content')
    <div class="bg-gradient-to-br from-blue-900 to-blue-700 pt-20 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-white">{{ $car->name }}</h1>
            <p class="text-blue-200">{{ $car->brand }} - {{ $car->year }}</p>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    @if($car->main_image)
                        <img src="{{ asset('storage/' . $car->main_image) }}" alt="{{ $car->name }}" class="w-full h-96 object-cover">
                    @elseif($car->images->first())
                        <img src="{{ asset('storage/' . $car->images->first()->image) }}" alt="{{ $car->name }}" class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                            <svg class="w-24 h-24 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                @if($car->images->count() > 0)
                    <div class="grid grid-cols-4 gap-4 mt-4">
                        @foreach($car->images as $image)
                            <img src="{{ asset('storage/' . $image->image) }}" class="rounded-lg h-24 w-full object-cover cursor-pointer hover:opacity-80 transition" onclick="document.getElementById('mainImage').src=this.src">
                        @endforeach
                    </div>
                @endif

                <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                    <h2 class="text-xl font-semibold mb-4">Deskripsi</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $car->description ?? 'Tidak ada deskripsi.' }}</p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                    <h2 class="text-xl font-semibold mb-4">Spesifikasi</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div><span class="text-sm text-gray-500">Transmisi</span><p class="font-medium">{{ $car->transmission === 'manual' ? 'Manual' : 'Otomatis' }}</p></div>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <div><span class="text-sm text-gray-500">Kapasitas</span><p class="font-medium">{{ $car->passenger_capacity }} Kursi</p></div>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <div><span class="text-sm text-gray-500">Merk</span><p class="font-medium">{{ $car->brand }}</p></div>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <div><span class="text-sm text-gray-500">Tahun</span><p class="font-medium">{{ $car->year }}</p></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                    <h3 class="text-lg font-semibold mb-4">Harga Sewa</h3>
                    <div class="text-3xl font-bold text-blue-600 mb-2">Rp {{ number_format($car->price_per_day, 0, ',', '.') }} <span class="text-base font-normal text-gray-500">/hari</span></div>

                    @if($car->driver_service_price ?? false)
                        <p class="text-sm text-gray-500 mb-4">Biaya sopir: Rp 150.000 /hari</p>
                    @endif

                    <div class="border-t border-gray-200 pt-4 mt-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Status</span>
                            @if($car->status === 'available')
                                <span class="text-green-600 font-medium">Tersedia</span>
                            @else
                                <span class="text-red-600 font-medium">Tidak Tersedia</span>
                            @endif
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Transmisi</span>
                            <span class="font-medium">{{ $car->transmission === 'manual' ? 'Manual' : 'Matic' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Kapasitas</span>
                            <span class="font-medium">{{ $car->passenger_capacity }} kursi</span>
                        </div>
                    </div>

                    @if($car->status === 'available')
                        <a href="{{ route('booking', $car) }}" class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-blue-700 transition mt-6">
                            Booking Sekarang
                        </a>
                        <a href="https://wa.me/6285934910789?text=Halo, saya tertarik dengan {{ urlencode($car->name) }}" target="_blank" class="block w-full bg-green-500 text-white text-center py-3 rounded-lg font-semibold hover:bg-green-600 transition mt-3">
                            <span class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                <span>Tanya via WhatsApp</span>
                            </span>
                        </a>
                    @else
                        <button disabled class="block w-full bg-gray-400 text-white text-center py-3 rounded-lg font-semibold cursor-not-allowed mt-6">
                            Mobil Tidak Tersedia
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
