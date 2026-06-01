@extends('layouts.admin')

@section('title', 'Detail Booking')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Detail Booking</h1>
        <a href="{{ route('admin.bookings.index') }}" class="text-gray-600 hover:text-gray-800">&larr; Kembali</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold mb-4">Informasi Booking</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Kode Booking</span>
                        <p class="font-semibold text-gray-800">{{ $booking->booking_code }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Status</span>
                        <p><span class="px-2 py-1 rounded-full text-xs font-medium {{ \App\Models\Booking::statusBadge($booking->booking_status) }}">{{ \App\Models\Booking::statusLabel($booking->booking_status) }}</span></p>
                    </div>
                    <div>
                        <span class="text-gray-500">Mobil</span>
                        <p class="font-semibold">{{ $booking->car->name }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Durasi</span>
                        <p class="font-semibold">{{ $booking->total_days }} hari</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Tanggal Mulai</span>
                        <p class="font-semibold">{{ $booking->start_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Tanggal Selesai</span>
                        <p class="font-semibold">{{ $booking->end_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Layanan Sopir</span>
                        <p class="font-semibold">{{ $booking->driver_service ? 'Ya (+Rp ' . number_format($booking->total_days * 150000, 0, ',', '.') . ')' : 'Tidak' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Lokasi Penjemputan</span>
                        <p class="font-semibold">{{ $booking->pickup_location }}</p>
                    </div>
                    <div class="col-span-2">
                        <span class="text-gray-500">Total Harga</span>
                        <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @if($booking->notes)
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-500">Catatan</span>
                        <p class="mt-1">{{ $booking->notes }}</p>
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold mb-4">Informasi Pelanggan</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Nama</span>
                        <p class="font-semibold">{{ $booking->user->name }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Email</span>
                        <p class="font-semibold">{{ $booking->user->email }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">No. Telepon</span>
                        <p class="font-semibold">{{ $booking->user->phone ?? '-' }}</p>
                    </div>
                </div>
            </div>

            @if($booking->payment)
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold mb-4">Informasi Pembayaran</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Metode Pembayaran</span>
                            <p class="font-semibold">{{ $booking->payment->payment_method ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Status</span>
                            <p>
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    @if($booking->payment->payment_status === 'paid') bg-green-100 text-green-700
                                    @elseif($booking->payment->payment_status === 'pending') bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($booking->payment->payment_status) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <span class="text-gray-500">Jumlah</span>
                            <p class="font-semibold">Rp {{ number_format($booking->payment->amount, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                <h3 class="text-lg font-semibold mb-4">Ubah Status</h3>
                <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="booking_status" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="pending" {{ $booking->booking_status === 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                        <option value="confirmed" {{ $booking->booking_status === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="in_progress" {{ $booking->booking_status === 'in_progress' ? 'selected' : '' }}>Sedang Berjalan</option>
                        <option value="completed" {{ $booking->booking_status === 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ $booking->booking_status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition">Perbarui Status</button>
                </form>

                <hr class="my-6">

                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Hapus booking ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg font-medium hover:bg-red-700 transition">Hapus Booking</button>
                </form>
            </div>
        </div>
    </div>
@endsection
