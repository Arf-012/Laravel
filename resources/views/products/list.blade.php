@extends('layouts.app')

@section('title', 'Products List')

@section('content')
    @auth
        <div class="container mx-auto p-6">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-indigo-600">
                    Inventaris Anda, {{ Auth::user()->name }}
                </h1>
                <div class="flex items-center gap-4">
                    <a href="{{ route('products.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                        <x-lucide-plus class="w-4 h-4 mr-2" />
                        Tambah Inventaris
                    </a>
                </div>
            </div>

            {{-- Products Table --}}
            <div class="bg-white rounded-lg shadow border border-gray-200 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
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
                                <td class="py-3 px-4 text-gray-800 font-medium">{{ $product->name }}</td>
                                <td class="py-3 px-4 text-gray-500">{{ Str::limit($product->description, 50) }}</td>
                                <td class="py-3 px-4 text-gray-800">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                                <td class="py-3 px-4">
                                    @if ($product->stock > 10)
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">
                                            In Stock ({{ $product->stock }})
                                        </span>
                                    @elseif($product->stock > 0)
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">
                                            Low Stock ({{ $product->stock }})
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 font-medium">
                                            Out of Stock
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('products.edit', $product) }}"
                                            class="inline-flex items-center px-2 py-1 text-indigo-600 hover:text-indigo-800">
                                            <x-lucide-edit class="w-4 h-4" />
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Yakin ingin hapus produk ini?')">
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

                {{-- Pagination --}}
                <div class="px-4 py-3 border-t border-gray-100">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    @endauth
@endsection
