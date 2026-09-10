@extends('layouts.admin')

@section('title', 'Laporan')
@section('header', 'Laporan')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Laporan</h1>
            <p class="text-sm text-gray-500 mt-0.5">Ringkasan data booking dan pendapatan</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 p-6 mb-6">
        <form action="{{ route('admin.reports.index') }}" method="GET" class="flex flex-wrap items-end gap-3">
            <div class="flex-1 min-w-[160px]">
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
            </div>
            <div class="flex-1 min-w-[160px]">
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
            </div>
            <div class="flex-1 min-w-[160px]">
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Status</label>
                <select name="status" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 bg-white">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>Sedang Berjalan</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-blue-700 transition-all duration-200 shadow-sm shadow-blue-600/20">Filter</button>
            <a href="{{ route('admin.reports.index') }}" class="px-4 py-2.5 text-sm text-gray-500 hover:text-gray-700 transition">Reset</a>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
        <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 p-6">
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-3">
                <svg class="w-4.5 h-4.5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider">Total Booking</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalBookings }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 p-6">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-3">
                <svg class="w-4.5 h-4.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider">Total Pendapatan</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-800">Daftar Booking</h3>
        </div>
        @if($bookings->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Kode</th>
                            <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Pelanggan</th>
                            <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Mobil</th>
                            <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Tanggal</th>
                            <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Durasi</th>
                            <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Total</th>
                            <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="py-3.5 px-6 font-medium text-gray-800">{{ $booking->booking_code }}</td>
                                <td class="py-3.5 px-6 text-gray-600">{{ $booking->user->name }}</td>
                                <td class="py-3.5 px-6 text-gray-600">{{ $booking->car->name }}</td>
                                <td class="py-3.5 px-6 text-gray-600">{{ $booking->start_date->format('d/m/Y') }}</td>
                                <td class="py-3.5 px-6 text-gray-600">{{ $booking->total_days }} hari</td>
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
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $bookings->withQueryString()->links('pagination::tailwind') }}
            </div>
        @else
            <div class="p-8 text-center">
                <p class="text-gray-400 text-sm">Tidak ada data booking ditemukan</p>
            </div>
        @endif
    </div>
@endsection
