@extends('layouts.admin')

@section('title', 'Manajemen Mobil')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Manajemen Mobil</h1>
        <a href="{{ route('admin.cars.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Mobil</span>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Mobil</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Merk</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Tahun</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Harga/Hari</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Transmisi</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Kapasitas</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Status</th>
                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $car)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg overflow-hidden shrink-0">
                                        @if($car->main_image)
                                            <img src="{{ asset('storage/' . $car->main_image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-blue-100 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="font-medium">{{ $car->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">{{ $car->brand }}</td>
                            <td class="py-3 px-4">{{ $car->year }}</td>
                            <td class="py-3 px-4">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">{{ $car->transmission === 'manual' ? 'Manual' : 'Matic' }}</td>
                            <td class="py-3 px-4">{{ $car->passenger_capacity }} kursi</td>
                            <td class="py-3 px-4">
                                @if($car->status === 'available')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">Tersedia</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-medium">Tidak Tersedia</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.cars.edit', $car) }}" class="text-blue-600 hover:text-blue-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Hapus mobil ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($cars->hasPages())
            <div class="p-4 border-t border-gray-200">
                {{ $cars->links() }}
            </div>
        @endif
    </div>
@endsection
