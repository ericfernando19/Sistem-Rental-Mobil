@extends('layouts.admin')

@section('title', 'Manajemen Booking')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Manajemen Booking</h1>
        <form action="{{ route('admin.bookings.index') }}" method="GET" class="flex items-center space-x-2">
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>Sedang Berjalan</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Kode</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Pelanggan</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Mobil</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Tanggal</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Total</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Status</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4 font-medium">{{ $booking->booking_code }}</td>
                            <td class="py-3 px-4">{{ $booking->user->name }}</td>
                            <td class="py-3 px-4">{{ $booking->car->name }}</td>
                            <td class="py-3 px-4">{{ $booking->start_date->format('d/m/Y') }} - {{ $booking->end_date->format('d/m/Y') }}</td>
                            <td class="py-3 px-4">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ \App\Models\Booking::statusBadge($booking->booking_status) }}">
                                    {{ \App\Models\Booking::statusLabel($booking->booking_status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="text-blue-600 hover:text-blue-700 font-medium">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($bookings->hasPages())
            <div class="p-4 border-t border-gray-200">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
@endsection
