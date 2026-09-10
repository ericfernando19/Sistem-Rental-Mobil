@extends('layouts.admin')

@section('title', 'Manajemen Mobil')
@section('header', 'Mobil')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Manajemen Mobil</h1>
            <p class="text-sm text-gray-500 mt-0.5">Kelola data mobil yang tersedia</p>
        </div>
        <a href="{{ route('admin.cars.create') }}" class="bg-blue-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-blue-700 transition-all duration-200 flex items-center space-x-2 shadow-sm shadow-blue-600/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Mobil</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Mobil</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Merk</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Tahun</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Harga/Hari</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Transmisi</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Kapasitas</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="py-3.5 px-6 text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $car)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gray-100 rounded-xl overflow-hidden shrink-0">
                                        @if($car->main_image)
                                            <img src="{{ asset('storage/' . $car->main_image) }}" class="w-full h-full object-cover">
                                        @elseif($car->images->first())
                                            <img src="{{ asset('storage/' . $car->images->first()->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-blue-50 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="font-medium text-gray-800">{{ $car->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-gray-600">{{ $car->brand }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $car->year }}</td>
                            <td class="py-4 px-6 font-medium text-gray-800">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $car->transmission === 'manual' ? 'Manual' : 'Matic' }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $car->passenger_capacity }} kursi</td>
                            <td class="py-4 px-6">
                                @if($car->status === 'available')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">Tersedia</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-red-50 text-red-600">Tidak Tersedia</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-1">
                                    <a href="{{ route('admin.cars.edit', $car) }}" class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Hapus mobil ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $cars->links() }}
            </div>
        @endif
    </div>
@endsection
