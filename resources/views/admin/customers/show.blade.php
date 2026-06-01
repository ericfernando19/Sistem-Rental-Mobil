@extends('layouts.admin')

@section('title', 'Detail Pelanggan')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Detail Pelanggan</h1>
        <a href="{{ route('admin.customers.index') }}" class="text-gray-600 hover:text-gray-800">&larr; Kembali</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="text-center">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl text-blue-600 font-bold">{{ substr($customer->name, 0, 1) }}</span>
                </div>
                <h2 class="text-xl font-semibold">{{ $customer->name }}</h2>
                <p class="text-gray-500 text-sm">{{ $customer->email }}</p>
                <p class="text-gray-500 text-sm">{{ $customer->phone ?? '-' }}</p>
                <p class="text-gray-400 text-xs mt-2">Bergabung {{ $customer->created_at->format('d M Y') }}</p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold mb-4">Riwayat Transaksi</h3>
            @forelse($customer->bookings as $booking)
                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                    <div>
                        <p class="font-medium text-sm">{{ $booking->car->name }}</p>
                        <p class="text-xs text-gray-500">{{ $booking->start_date->format('d M Y') }} - {{ $booking->end_date->format('d M Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ \App\Models\Booking::statusBadge($booking->booking_status) }}">
                            {{ \App\Models\Booking::statusLabel($booking->booking_status) }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-sm">Belum ada transaksi.</p>
            @endforelse
        </div>
    </div>
@endsection
