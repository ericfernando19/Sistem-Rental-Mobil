<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($cars as $car)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition group">
            <div class="relative h-48 bg-gray-200 overflow-hidden">
                @if($car->main_image)
                    <img src="{{ asset('storage/' . $car->main_image) }}" alt="{{ $car->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                @elseif($car->images->first())
                    <img src="{{ asset('storage/' . $car->images->first()->image) }}" alt="{{ $car->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
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
                    <span>{{ $car->year }}</span>
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
        <div class="col-span-full text-center py-16">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <p class="text-gray-500 text-lg">Mobil tidak ditemukan</p>
            <p class="text-gray-400 mt-1">Coba ubah filter pencarian Anda</p>
        </div>
    @endforelse
</div>

@if($cars->hasPages())
    <div class="mt-8">
        {{ $cars->links() }}
    </div>
@endif
