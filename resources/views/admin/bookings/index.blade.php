@extends('layouts.admin')

@section('title', 'Manajemen Booking')
@section('header', 'Booking')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Manajemen Booking</h1>
            <p class="text-sm text-gray-500 mt-0.5">Kelola semua transaksi booking</p>
        </div>
        <form action="{{ route('admin.bookings.index') }}" method="GET" class="flex items-center space-x-2">
            <select name="status" class="border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white transition-all duration-200">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>Sedang Berjalan</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-blue-700 transition-all duration-200 shadow-sm shadow-blue-600/20">Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Kode</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Pelanggan</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Mobil</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Total</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 font-medium text-gray-800">{{ $booking->booking_code }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $booking->user->name }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $booking->car->name }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $booking->start_date->format('d/m/Y') }} - {{ $booking->end_date->format('d/m/Y') }}</td>
                            <td class="py-4 px-6 font-medium text-gray-800">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-medium {{ \App\Models\Booking::statusBadge($booking->booking_status) }}">
                                    {{ \App\Models\Booking::statusLabel($booking->booking_status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($bookings->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
@endsection
