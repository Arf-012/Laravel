@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block mb-1 font-semibold">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-1 font-semibold">Deskripsi</label>
            <textarea name="description" id="description" rows="4"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="price" class="block mb-1 font-semibold">Harga (Rp)</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required step="0.01"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Gambar Produk Saat Ini</label>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded mb-3">
            @else
                <p class="text-gray-500 italic">Belum ada gambar</p>
            @endif
        </div>

        <div class="mb-6">
            <label for="image" class="block mb-1 font-semibold">Ganti Gambar Produk (opsional)</label>
            <input type="file" name="image" id="image" accept="image/*" class="w-full">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Update</button>
    </form>
@endsection
