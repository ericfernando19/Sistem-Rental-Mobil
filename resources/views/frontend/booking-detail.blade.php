@extends('layouts.frontend')

@section('title', 'Detail Booking')

@section('content')
    <div class="bg-gradient-to-br from-blue-900 to-blue-700 pt-20 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-white">Detail Booking</h1>
            <p class="text-blue-200">Kode: {{ $booking->booking_code }}</p>
        </div>
    </div>

    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold">Informasi Booking</h2>
                <span class="px-3 py-1 rounded-full text-xs font-medium {{ \App\Models\Booking::statusBadge($booking->booking_status) }}">
                    {{ \App\Models\Booking::statusLabel($booking->booking_status) }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <span class="text-sm text-gray-500">Kode Booking</span>
                    <p class="font-semibold">{{ $booking->booking_code }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Mobil</span>
                    <p class="font-semibold">{{ $booking->car->name }} ({{ $booking->car->brand }})</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Tanggal Mulai</span>
                    <p class="font-semibold">{{ $booking->start_date->format('d M Y') }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Tanggal Selesai</span>
                    <p class="font-semibold">{{ $booking->end_date->format('d M Y') }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Durasi</span>
                    <p class="font-semibold">{{ $booking->total_days }} hari</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Lokasi Penjemputan</span>
                    <p class="font-semibold">{{ $booking->pickup_location }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Layanan Sopir</span>
                    <p class="font-semibold">{{ $booking->driver_service ? 'Ya' : 'Tidak' }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Total Harga</span>
                    <p class="font-semibold text-blue-600 text-lg">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                </div>
            </div>

            @if($booking->notes)
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <span class="text-sm text-gray-500">Catatan</span>
                    <p class="mt-1">{{ $booking->notes }}</p>
                </div>
            @endif

            @php
                $whatsappMessage = urlencode("Halo, saya ingin mengkonfirmasi booking dengan kode: {$booking->booking_code}");
            @endphp

            @if($booking->booking_status === 'pending')
                <div class="border-t border-gray-200 pt-6">
                    <p class="text-sm text-gray-500 mb-4">Booking Anda sedang menunggu konfirmasi. Hubungi admin untuk mempercepat proses.</p>
                    <a href="https://wa.me/6281234567890?text={{ $whatsappMessage }}" target="_blank" class="inline-flex items-center space-x-2 bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        <span>Konfirmasi via WhatsApp</span>
                    </a>
                </div>
            @endif

            <div class="mt-6 flex justify-between">
                <a href="{{ route('riwayat') }}" class="text-blue-600 hover:text-blue-700 font-medium">&larr; Kembali</a>
            </div>
        </div>
    </section>
@endsection
