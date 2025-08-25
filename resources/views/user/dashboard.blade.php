@extends('layouts.form')

@section('title', 'My Products')

@section('content')
    @auth
        <header class="bg-white border-b border-gray-200 px-6 py-4 ">
            <h2 class="text-2xl font-bold text-gray-800">
                Hello, {{ Auth::user()->name }}
            </h2>
        </header>

        <main class="p-6 space-y-6">
            {{-- Daftar Produk --}}
            <div class="bg-white rounded-lg shadow border border-gray-200 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-semibold text-indigo-600">Images</th>
                            <th class="text-left py-3 px-4 font-semibold text-indigo-600">Name</th>
                            <th class="text-left py-3 px-4 font-semibold text-indigo-600">Description</th>
                            <th class="text-left py-3 px-4 font-semibold text-indigo-600">Price</th>
                            <th class="text-left py-3 px-4 font-semibold text-indigo-600">Stock</th>
                            <th class="text-left py-3 px-4 font-semibold text-indigo-600">Action</th>
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
                                <td class="py-3 px-4">{{ $product->name }}</td>
                                <td class="py-3 px-4">{{ Str::limit($product->description, 50) }}</td>
                                <td class="py-3 px-4">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                                <td class="py-3 px-4">{{ $product->stock }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('user.products.edit', $product) }}"
                                           class="text-indigo-600 hover:text-indigo-800">
                                           Edit
                                        </a>
                                        <form action="{{ route('user.products.destroy', $product) }}" method="POST"
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">
                                    No products yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="px-4 py-3 border-t border-gray-100">
                    {{ $products->links() }}
                </div>
            </div>
        </main>
    @endauth
@endsection
