@extends('layouts.frontend')

@section('title', 'Riwayat Booking')

@section('content')
    <div class="bg-gradient-to-br from-blue-900 to-blue-700 pt-20 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-white">Riwayat Booking</h1>
            <p class="text-blue-200">Daftar booking mobil Anda</p>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6">
        @forelse($bookings as $booking)
            <div class="bg-white rounded-xl shadow-md p-6 mb-4 hover:shadow-lg transition">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-start space-x-4">
                        <div class="w-20 h-20 bg-gray-200 rounded-lg overflow-hidden shrink-0">
                            @if($booking->car->main_image)
                                <img src="{{ asset('storage/' . $booking->car->main_image) }}" class="w-full h-full object-cover">
                            @elseif($booking->car->images->first())
                                <img src="{{ asset('storage/' . $booking->car->images->first()->image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-blue-100 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">{{ $booking->booking_code }}</p>
                            <h3 class="font-semibold text-gray-800">{{ $booking->car->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $booking->start_date->format('d M Y') }} - {{ $booking->end_date->format('d M Y') }} ({{ $booking->total_days }} hari)</p>
                            <p class="text-blue-600 font-semibold mt-1">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col md:items-end space-y-2">
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ \App\Models\Booking::statusBadge($booking->booking_status) }}">
                            {{ \App\Models\Booking::statusLabel($booking->booking_status) }}
                        </span>
                        <a href="{{ route('booking.detail', $booking) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <p class="text-gray-500 text-lg">Belum ada booking</p>
                <a href="{{ route('catalog') }}" class="text-blue-600 hover:text-blue-700 font-medium mt-2 inline-block">Sewa Mobil Sekarang</a>
            </div>
        @endforelse

        <div class="mt-6">
            {{ $bookings->links() }}
        </div>
    </section>
@endsection
