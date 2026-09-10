@extends('layouts.admin')

@section('title', 'Detail Booking')
@section('header', 'Detail Booking')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Detail Booking</h1>
            <p class="text-sm text-gray-500 mt-0.5">{{ $booking->booking_code }}</p>
        </div>
        <a href="{{ route('admin.bookings.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition flex items-center space-x-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div class="lg:col-span-2 space-y-5">
            <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 p-6">
                <h3 class="text-sm font-semibold text-gray-800 mb-4">Informasi Booking</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-400 text-xs">Kode Booking</span>
                        <p class="font-semibold text-gray-800 mt-0.5">{{ $booking->booking_code }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400 text-xs">Status</span>
                        <p class="mt-0.5"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-medium {{ \App\Models\Booking::statusBadge($booking->booking_status) }}">{{ \App\Models\Booking::statusLabel($booking->booking_status) }}</span></p>
                    </div>
                    <div>
                        <span class="text-gray-400 text-xs">Mobil</span>
                        <p class="font-semibold text-gray-800 mt-0.5">{{ $booking->car->name }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400 text-xs">Durasi</span>
                        <p class="font-semibold text-gray-800 mt-0.5">{{ $booking->total_days }} hari</p>
                    </div>
                    <div>
                        <span class="text-gray-400 text-xs">Tanggal Mulai</span>
                        <p class="font-semibold text-gray-800 mt-0.5">{{ $booking->start_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400 text-xs">Tanggal Selesai</span>
                        <p class="font-semibold text-gray-800 mt-0.5">{{ $booking->end_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400 text-xs">Layanan Sopir</span>
                        <p class="font-semibold text-gray-800 mt-0.5">{{ $booking->driver_service ? 'Ya (+Rp ' . number_format($booking->total_days * 150000, 0, ',', '.') . ')' : 'Tidak' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400 text-xs">Lokasi Penjemputan</span>
                        <p class="font-semibold text-gray-800 mt-0.5">{{ $booking->pickup_location }}</p>
                    </div>
                    <div class="col-span-2 pt-3 border-t border-gray-100">
                        <span class="text-gray-400 text-xs">Total Harga</span>
                        <p class="text-2xl font-bold text-blue-600 mt-0.5">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @if($booking->notes)
                    <div class="mt-4 p-3.5 bg-gray-50 rounded-xl">
                        <span class="text-xs font-medium text-gray-400">Catatan</span>
                        <p class="text-sm text-gray-600 mt-1">{{ $booking->notes }}</p>
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 p-6">
                <h3 class="text-sm font-semibold text-gray-800 mb-4">Informasi Pelanggan</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-400 text-xs">Nama</span>
                        <p class="font-semibold text-gray-800 mt-0.5">{{ $booking->user->name }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400 text-xs">Email</span>
                        <p class="font-semibold text-gray-800 mt-0.5">{{ $booking->user->email }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400 text-xs">No. Telepon</span>
                        <p class="font-semibold text-gray-800 mt-0.5">{{ $booking->user->phone ?? '-' }}</p>
                    </div>
                </div>
            </div>

            @if($booking->payment)
                <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 p-6">
                    <h3 class="text-sm font-semibold text-gray-800 mb-4">Informasi Pembayaran</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-400 text-xs">Metode Pembayaran</span>
                            <p class="font-semibold text-gray-800 mt-0.5">{{ $booking->payment->payment_method ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400 text-xs">Status</span>
                            <p class="mt-0.5">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-medium
                                    @if($booking->payment->payment_status === 'paid') bg-emerald-50 text-emerald-600
                                    @elseif($booking->payment->payment_status === 'pending') bg-amber-50 text-amber-600
                                    @else bg-red-50 text-red-600 @endif">
                                    {{ ucfirst($booking->payment->payment_status) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <span class="text-gray-400 text-xs">Jumlah</span>
                            <p class="font-semibold text-gray-800 mt-0.5">Rp {{ number_format($booking->payment->amount, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 p-6 sticky top-24">
                <h3 class="text-sm font-semibold text-gray-800 mb-4">Ubah Status</h3>
                <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="booking_status" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm mb-3 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 bg-white">
                        <option value="pending" {{ $booking->booking_status === 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                        <option value="confirmed" {{ $booking->booking_status === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="in_progress" {{ $booking->booking_status === 'in_progress' ? 'selected' : '' }}>Sedang Berjalan</option>
                        <option value="completed" {{ $booking->booking_status === 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ $booking->booking_status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-xl text-sm font-medium hover:bg-blue-700 transition-all duration-200 shadow-sm shadow-blue-600/20">Perbarui Status</button>
                </form>

                <div class="my-5 border-t border-gray-100"></div>

                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Hapus booking ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-50 text-red-600 py-2.5 rounded-xl text-sm font-medium hover:bg-red-100 transition-all duration-200">Hapus Booking</button>
                </form>
            </div>
        </div>
    </div>
@endsection
