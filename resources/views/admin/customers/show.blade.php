@extends('layouts.admin')

@section('title', 'Detail Pelanggan')
@section('header', 'Detail Pelanggan')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Detail Pelanggan</h1>
            <p class="text-sm text-gray-500 mt-0.5">{{ $customer->name }}</p>
        </div>
        <a href="{{ route('admin.customers.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition flex items-center space-x-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 p-6">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 font-bold text-xl mb-3">{{ substr($customer->name, 0, 1) }}</div>
                    <h2 class="text-lg font-semibold text-gray-800">{{ $customer->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $customer->email }}</p>
                    <div class="mt-4 w-full space-y-2.5 text-sm">
                        <div class="flex items-center justify-between py-2.5 border-b border-gray-100">
                            <span class="text-gray-400">Telepon</span>
                            <span class="font-medium text-gray-800">{{ $customer->phone ?? '-' }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2.5 border-b border-gray-100">
                            <span class="text-gray-400">Total Booking</span>
                            <span class="font-medium text-gray-800">{{ $customer->bookings_count }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2.5">
                            <span class="text-gray-400">Bergabung</span>
                            <span class="font-medium text-gray-800">{{ $customer->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-800">Riwayat Transaksi</h3>
                </div>
                @if($customer->bookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Mobil</th>
                                    <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Tanggal</th>
                                    <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Total</th>
                                    <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->bookings as $booking)
                                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                        <td class="py-3.5 px-6 font-medium text-gray-800">{{ $booking->car->name }}</td>
                                        <td class="py-3.5 px-6 text-gray-600">{{ $booking->start_date->format('d/m/Y') }} - {{ $booking->end_date->format('d/m/Y') }}</td>
                                        <td class="py-3.5 px-6 font-medium text-gray-800">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                        <td class="py-3.5 px-6">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-medium {{ \App\Models\Booking::statusBadge($booking->booking_status) }}">
                                                {{ \App\Models\Booking::statusLabel($booking->booking_status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center">
                        <p class="text-gray-400 text-sm">Belum ada riwayat transaksi</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
