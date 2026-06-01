@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Laporan</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <form action="{{ route('admin.reports.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>Sedang Berjalan</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Filter</button>
            <a href="{{ route('admin.reports.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">Reset</a>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <p class="text-sm text-gray-500">Total Booking</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalBookings }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <p class="text-sm text-gray-500">Total Pendapatan</p>
            <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="font-semibold">Daftar Booking</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Kode</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Pelanggan</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Mobil</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Tanggal</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Durasi</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Total</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr class="border-b border-gray-100">
                            <td class="py-3 px-4 font-medium">{{ $booking->booking_code }}</td>
                            <td class="py-3 px-4">{{ $booking->user->name }}</td>
                            <td class="py-3 px-4">{{ $booking->car->name }}</td>
                            <td class="py-3 px-4">{{ $booking->start_date->format('d/m/Y') }}</td>
                            <td class="py-3 px-4">{{ $booking->total_days }} hari</td>
                            <td class="py-3 px-4">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ \App\Models\Booking::statusBadge($booking->booking_status) }}">
                                    {{ \App\Models\Booking::statusLabel($booking->booking_status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
