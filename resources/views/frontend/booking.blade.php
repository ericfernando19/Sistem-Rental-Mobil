@extends('layouts.frontend')

@section('title', 'Booking ' . $car->name)

@section('content')
    <div class="bg-gradient-to-br from-blue-900 to-blue-700 pt-20 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-white">Booking Mobil</h1>
            <p class="text-blue-200">{{ $car->name }}</p>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-data="bookingForm()">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6">Form Booking</h2>

                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <input type="hidden" name="price_per_day" value="{{ $car->price_per_day }}">

                        @guest
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        @endguest

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai Sewa</label>
                                <input type="date" name="start_date" x-model="startDate" :min="today" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('start_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai Sewa</label>
                                <input type="date" name="end_date" x-model="endDate" :min="startDate || today" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('end_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Penjemputan</label>
                            <input type="text" name="pickup_location" value="{{ old('pickup_location') }}" placeholder="Masukkan alamat penjemputan" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('pickup_location')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg cursor-pointer">
                                <input type="checkbox" name="driver_service" x-model="driverService" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <div>
                                    <span class="font-medium text-gray-800">Tambahkan Sopir</span>
                                    <p class="text-sm text-gray-500">Biaya sopir Rp 150.000 /hari</p>
                                </div>
                            </label>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                            <textarea name="notes" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                            Konfirmasi Booking
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                    <h3 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h3>

                    <div class="flex items-center space-x-3 pb-4 border-b border-gray-200 mb-4">
                        <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden">
                            @if($car->main_image)
                                <img src="{{ asset('storage/' . $car->main_image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-blue-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $car->name }}</p>
                            <p class="text-sm text-gray-500">{{ $car->brand }} - {{ $car->year }}</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Harga Sewa</span>
                            <span class="font-medium">Rp <span x-text="pricePerDay.toLocaleString('id-ID')"></span> /hari</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Durasi</span>
                            <span class="font-medium"><span x-text="totalDays || 0"></span> hari</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Biaya Sewa</span>
                            <span class="font-medium">Rp <span x-text="rentalPrice.toLocaleString('id-ID')"></span></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Sopir</span>
                            <span class="font-medium" x-text="driverService ? 'Rp ' + driverTotal.toLocaleString('id-ID') : 'Tidak'"></span>
                        </div>
                        <div class="border-t border-gray-200 pt-3 mt-3 flex justify-between">
                            <span class="font-semibold text-gray-800">Total</span>
                            <span class="font-bold text-lg text-blue-600">Rp <span x-text="totalPrice.toLocaleString('id-ID')"></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('bookingForm', () => ({
        today: new Date().toISOString().split('T')[0],
        startDate: '',
        endDate: '',
        driverService: false,
        pricePerDay: {{ $car->price_per_day }},
        driverPrice: 150000,
        get totalDays() {
            if (!this.startDate || !this.endDate) return 0;
            const start = new Date(this.startDate);
            const end = new Date(this.endDate);
            const diff = Math.floor((end - start) / (1000 * 60 * 60 * 24));
            return diff >= 0 ? diff + 1 : 0;
        },
        get rentalPrice() { return this.totalDays * this.pricePerDay; },
        get driverTotal() { return this.driverService ? this.totalDays * this.driverPrice : 0; },
        get totalPrice() { return this.rentalPrice + this.driverTotal; },
    }));
});
</script>
@endpush
