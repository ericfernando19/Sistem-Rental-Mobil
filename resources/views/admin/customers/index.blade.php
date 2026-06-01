@extends('layouts.admin')

@section('title', 'Manajemen Pelanggan')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Manajemen Pelanggan</h1>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Nama</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Email</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Telepon</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Total Booking</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Bergabung</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-semibold text-sm">{{ substr($customer->name, 0, 1) }}</div>
                                    <span class="font-medium">{{ $customer->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">{{ $customer->email }}</td>
                            <td class="py-3 px-4">{{ $customer->phone ?? '-' }}</td>
                            <td class="py-3 px-4">{{ $customer->bookings_count }}</td>
                            <td class="py-3 px-4">{{ $customer->created_at->format('d M Y') }}</td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.customers.show', $customer) }}" class="text-blue-600 hover:text-blue-700 font-medium">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($customers->hasPages())
            <div class="p-4 border-t border-gray-200">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
@endsection
