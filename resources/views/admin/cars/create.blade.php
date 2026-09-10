@extends('layouts.admin')

@section('title', 'Tambah Mobil')
@section('header', 'Tambah Mobil')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Tambah Mobil</h1>
            <p class="text-sm text-gray-500 mt-0.5">Tambahkan mobil baru ke dalam sistem</p>
        </div>
        <a href="{{ route('admin.cars.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition flex items-center space-x-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 p-6">
        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Mobil</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                @error('name')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Merk</label>
                <input type="text" name="brand" value="{{ old('brand') }}" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                @error('brand')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tahun</label>
                <input type="number" name="year" value="{{ old('year', date('Y')) }}" min="2000" max="{{ date('Y') + 1 }}" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                @error('year')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Harga per Hari (Rp)</label>
                <input type="number" name="price_per_day" value="{{ old('price_per_day') }}" min="0" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                @error('price_per_day')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Transmisi</label>
                <select name="transmission" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 bg-white">
                    <option value="manual" {{ old('transmission') === 'manual' ? 'selected' : '' }}>Manual</option>
                    <option value="automatic" {{ old('transmission') === 'automatic' ? 'selected' : '' }}>Matic</option>
                </select>
                @error('transmission')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kapasitas Penumpang</label>
                <input type="number" name="passenger_capacity" value="{{ old('passenger_capacity', 4) }}" min="1" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                @error('passenger_capacity')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                <select name="status" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 bg-white">
                    <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="unavailable" {{ old('status') === 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
                @error('status')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto Utama</label>
                <input type="file" name="main_image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                @error('main_image')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto Tambahan (bisa lebih dari 1)</label>
                <input type="file" name="images[]" multiple accept="image/*" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                @error('images.*')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 resize-none">{{ old('description') }}</textarea>
                @error('description')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div class="md:col-span-2 flex items-center space-x-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-blue-700 transition-all duration-200 shadow-sm shadow-blue-600/20">Simpan</button>
                <a href="{{ route('admin.cars.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 transition-all duration-200">Batal</a>
            </div>
        </form>
    </div>
@endsection
