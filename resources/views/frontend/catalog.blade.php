@extends('layouts.frontend')

@section('title', 'Katalog Mobil')

@section('content')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('catalogFilter', () => ({
                filters: {
                    search: '{{ request('search') }}',
                    transmission: '{{ request('transmission') }}',
                    capacity: '{{ request('capacity') }}',
                },
                loading: false,
                resultsHtml: {!! json_encode($resultsHtml) !!},
                init() {
                    this.$watch('filters.search', () => this.fetchResults());
                    this.$watch('filters.transmission', () => this.fetchResults());
                    this.$watch('filters.capacity', () => this.fetchResults());
                },
                async fetchResults() {
                    this.loading = true;
                    const params = new URLSearchParams();
                    Object.entries(this.filters).forEach(([key, val]) => {
                        if (val) params.append(key, val);
                    });
                    const url = `{{ route('catalog.search') }}?${params.toString()}`;
                    try {
                        const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                        this.resultsHtml = await res.text();
                        const newUrl = params.toString() ? `/catalog?${params.toString()}` : '/catalog';
                        history.replaceState(null, '', newUrl);
                    } catch (e) {
                        console.error('Search failed:', e);
                    }
                    this.loading = false;
                },
                resetFilters() {
                    this.filters = { search: '', transmission: '', capacity: '' };
                    this.fetchResults();
                }
            }));
        });
    </script>

    <div class="bg-gradient-to-br from-blue-900 to-blue-700 pt-20 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-white mb-2">Katalog Mobil</h1>
            <p class="text-blue-200">Temukan mobil impian Anda</p>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="catalogFilter()">
        <div class="bg-white p-6 rounded-xl shadow-md -mt-12 relative z-10 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                    <input type="text" x-model="filters.search" placeholder="Nama atau merk mobil..." class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Transmisi</label>
                    <select x-model="filters.transmission" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua</option>
                        <option value="manual">Manual</option>
                        <option value="automatic">Matic</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                    <select x-model="filters.capacity" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua</option>
                        @foreach([4, 5, 6, 7, 8] as $cap)
                            <option value="{{ $cap }}">{{ $cap }} Kursi</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                <button @click="resetFilters()" type="button" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition">Reset</button>
            </div>
        </div>

        <div id="catalog-results" class="relative">
            <div x-show="loading" class="absolute inset-0 bg-white/60 z-10 flex items-center justify-center rounded-xl">
                <svg class="animate-spin h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>
            <div x-html="resultsHtml"></div>
        </div>
    </section>
@endsection
