@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @auth
        {{-- Header --}}
        <header class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 font-[family-name:var(--font-space-grotesk)]">
                        Hi there, {{ Auth::user()->name }}
                    </h2>
                </div>
        </header>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 mt-7">
            {{-- Total Products --}}
            <div class="bg-white rounded-lg shadow p-4 flex items-center justify-between border border-gray-200">
                <div>
                    <p class="text-sm text-gray-500">Total Products</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</p>
                </div>
                <x-lucide-box class="w-8 h-8 text-indigo-600" />
            </div>

            {{-- Low Stock Alerts --}}
            <div class="bg-white rounded-lg shadow p-4 flex items-center justify-between border border-gray-200">
                <div>
                    <p class="text-sm text-gray-500">Low Stock Alerts</p>
                    <p class="text-2xl font-bold text-yellow-700">{{ $lowStockCount }}</p>
                </div>
                <x-lucide-alert-triangle class="w-8 h-8 text-yellow-500" />
            </div>

            {{-- Active Users --}}
            <div class="bg-white rounded-lg shadow p-4 flex items-center justify-between border border-gray-200">
                <div>
                    <p class="text-sm text-gray-500">Active Users</p>
                    <p class="text-2xl font-bold text-green-700">{{ $activeUsers }}</p>
                </div>
                <x-lucide-users class="w-8 h-8 text-green-500" />
            </div>
        </div>

        {{-- Content --}}
        <main class="p-6 space-y-6">
            {{-- Table Card --}}
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="flex items-center justify-center px-4 py-3 border-b border-gray-100">
                    <h3 class="text-lg justify-center font-semibold text-gray-700 font-[family-name:var(--font-space-grotesk)]">
                        Daftar Inventaris
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-indigo-600">Gambar</th>
                                <th class="text-left py-3 px-4 font-semibold text-indigo-600">Nama</th>
                                <th class="text-left py-3 px-4 font-semibold text-indigo-600">Deskripsi</th>
                                <th class="text-left py-3 px-4 font-semibold text-indigo-600">Harga</th>
                                <th class="text-left py-3 px-4 font-semibold text-indigo-600">Stock</th>
                                <th class="text-left py-3 px-4 font-semibold text-indigo-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                class="w-14 h-14 object-cover rounded-md">
                                        @else
                                            <span class="text-gray-400 italic">No image</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-gray-800">{{ $product->name }}</td>
                                    <td class="py-3 px-4 text-gray-500">{{ Str::limit($product->description, 50) }}</td>
                                    <td class="py-3 px-4 text-gray-800">Rp {{ number_format($product->price, 2, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-4">
                                        @if ($product->stock > 10)
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">In
                                                Stock ({{ $product->stock }})</span>
                                        @elseif($product->stock > 0)
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">Low
                                                Stock ({{ $product->stock }})</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 font-medium">Out
                                                of Stock</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('products.edit', $product) }}"
                                                class="inline-flex items-center px-2 py-1 text-indigo-600 hover:text-indigo-800">
                                                <x-lucide-edit class="w-4 h-4" />
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                class="inline" onsubmit="return confirm('Yakin ingin hapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">
                                                    <x-lucide-trash-2 class="w-4 h-4" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">Belum ada produk</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-4 py-3 border-t border-gray-100">
                    {{ $products->links() }}
                </div>
            </div>
        </main>
    @endauth
@endsection
