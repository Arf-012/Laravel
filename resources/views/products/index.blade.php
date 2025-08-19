@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">Daftar Produk</h1>

    <table class="w-full border-collapse border border-gray-300 bg-white rounded shadow">
        <thead>
            <tr class="bg-indigo-100">
                <th class="border border-gray-300 px-4 py-2">Gambar</th>
                <th class="border border-gray-300 px-4 py-2">Nama</th>
                <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                <th class="border border-gray-300 px-4 py-2">Harga</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                <th class="border border-gray-300 px-4 py-2">Stock</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr class="hover:bg-indigo-50">
                    <td class="border border-gray-300 px-4 py-2">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-400 italic">No image</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ Str::limit($product->description, 50) }}</td>
                    <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('products.edit', $product) }}"
                            class="text-indigo-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin ingin hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if ($product->stock > 0)
                            <span class="text-green-600 font-semibold">{{ $product->stock }}</span>
                        @else
                            <span class="text-red-500 italic">Habis</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">Belum ada produk</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection
