@extends('layouts.admin')

@section('title', 'Manajemen Pelanggan')
@section('header', 'Pelanggan')

@section('content')
    <div class="mb-6">
        <h1 class="text-lg font-semibold text-gray-800">Manajemen Pelanggan</h1>
        <p class="text-sm text-gray-500 mt-0.5">Daftar semua pelanggan yang terdaftar</p>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Nama</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Email</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Telepon</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Total Booking</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Bergabung</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 font-semibold text-xs">{{ substr($customer->name, 0, 1) }}</div>
                                    <span class="font-medium text-gray-800">{{ $customer->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-gray-600">{{ $customer->email }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $customer->phone ?? '-' }}</td>
                            <td class="py-4 px-6 text-gray-800">{{ $customer->bookings_count }}</td>
                            <td class="py-4 px-6 text-gray-500">{{ $customer->created_at->format('d M Y') }}</td>
                            <td class="py-4 px-6">
                                <a href="{{ route('admin.customers.show', $customer) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($customers->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
@endsection
