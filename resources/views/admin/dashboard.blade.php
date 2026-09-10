@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white rounded-2xl p-5 shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total Mobil</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalCars }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total Pelanggan</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalCustomers }}</p>
                </div>
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total Booking</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalBookings }}</p>
                </div>
                <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Pendapatan</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <div class="w-10 h-10 bg-violet-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80">
            <h3 class="text-sm font-semibold text-gray-800 mb-4">Pendapatan Bulanan</h3>
            <canvas id="revenueChart" height="200"></canvas>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80">
            <h3 class="text-sm font-semibold text-gray-800 mb-4">Booking Bulanan</h3>
            <canvas id="bookingChart" height="200"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-800">Booking Terbaru</h3>
            <a href="{{ route('admin.bookings.index') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700 transition">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Kode</th>
                        <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Pelanggan</th>
                        <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Mobil</th>
                        <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Total</th>
                        <th class="py-3 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBookings as $booking)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="py-3.5 px-6 font-medium text-gray-800">{{ $booking->booking_code }}</td>
                            <td class="py-3.5 px-6 text-gray-600">{{ $booking->user->name }}</td>
                            <td class="py-3.5 px-6 text-gray-600">{{ $booking->car->name }}</td>
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
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: @json(array_values($monthlyRevenue->toArray())),
                backgroundColor: 'rgba(99, 102, 241, 0.15)',
                borderColor: 'rgb(99, 102, 241)',
                borderWidth: 1.5,
                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { callback: v => 'Rp' + v.toLocaleString('id-ID'), font: { size: 11 } }, grid: { color: 'rgba(0,0,0,0.04)' } },
                x: { grid: { display: false }, ticks: { font: { size: 11 } } }
            }
        }
    });

    new Chart(document.getElementById('bookingChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Booking',
                data: @json(array_values($monthlyBookings->toArray())),
                borderColor: 'rgb(99, 102, 241)',
                backgroundColor: 'rgba(99, 102, 241, 0.08)',
                fill: true,
                tension: 0.4,
                borderWidth: 2,
                pointRadius: 3,
                pointBackgroundColor: 'rgb(99, 102, 241)'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11 } }, grid: { color: 'rgba(0,0,0,0.04)' } },
                x: { grid: { display: false }, ticks: { font: { size: 11 } } }
            }
        }
    });
});
</script>
@endpush
