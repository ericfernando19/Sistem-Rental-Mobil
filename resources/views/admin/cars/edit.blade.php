@extends('layouts.admin')

@section('title', 'Edit Mobil')
@section('header', 'Edit Mobil')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Edit Mobil</h1>
            <p class="text-sm text-gray-500 mt-0.5">{{ $car->name }}</p>
        </div>
        <a href="{{ route('admin.cars.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition flex items-center space-x-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-gray-100/80 p-6">
        <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Mobil</label>
                <input type="text" name="name" value="{{ old('name', $car->name) }}" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                @error('name')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Merk</label>
                <input type="text" name="brand" value="{{ old('brand', $car->brand) }}" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                @error('brand')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tahun</label>
                <input type="number" name="year" value="{{ old('year', $car->year) }}" min="2000" max="{{ date('Y') + 1 }}" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                @error('year')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Harga per Hari (Rp)</label>
                <input type="number" name="price_per_day" value="{{ old('price_per_day', $car->price_per_day) }}" min="0" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                @error('price_per_day')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Transmisi</label>
                <select name="transmission" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 bg-white">
                    <option value="manual" {{ old('transmission', $car->transmission) === 'manual' ? 'selected' : '' }}>Manual</option>
                    <option value="automatic" {{ old('transmission', $car->transmission) === 'automatic' ? 'selected' : '' }}>Matic</option>
                </select>
                @error('transmission')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kapasitas Penumpang</label>
                <input type="number" name="passenger_capacity" value="{{ old('passenger_capacity', $car->passenger_capacity) }}" min="1" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                @error('passenger_capacity')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                <select name="status" required class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 bg-white">
                    <option value="available" {{ old('status', $car->status) === 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="unavailable" {{ old('status', $car->status) === 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
                @error('status')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Ganti Foto Utama</label>
                @if($car->main_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $car->main_image) }}" alt="{{ $car->name }}" class="w-full h-36 object-cover rounded-xl">
                        <p class="text-xs text-gray-400 mt-1.5">Biarkan kosong jika tidak ingin mengganti</p>
                    </div>
                @endif
                <input type="file" name="main_image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                @error('main_image')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto Tambahan</label>
                <input type="file" name="images[]" multiple accept="image/*" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
            </div>
            @if($car->images->count() > 0)
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                    <div class="grid grid-cols-4 gap-3">
                        @foreach($car->images as $image)
                            <div class="relative group rounded-xl overflow-hidden">
                                <img src="{{ asset('storage/' . $image->image) }}" class="w-full h-24 object-cover">
                                <a href="{{ route('admin.cars.delete-image', $image) }}" class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-200" onclick="return confirm('Hapus gambar?')">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 resize-none">{{ old('description', $car->description) }}</textarea>
                @error('description')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div class="md:col-span-2 flex items-center space-x-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-blue-700 transition-all duration-200 shadow-sm shadow-blue-600/20">Perbarui</button>
                <a href="{{ route('admin.cars.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 transition-all duration-200">Batal</a>
            </div>
        </form>
    </div>
@endsection
