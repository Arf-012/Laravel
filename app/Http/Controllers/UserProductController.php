<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProductController extends Controller
{
    // Tampilkan daftar produk milik user
    public function index(Request $request)
    {
        $query = Product::where('user_id', Auth::id());

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(10);
        $products->appends($request->all());

        return view('user.dashboard', compact('products'));
    }

    // Tampilkan form tambah produk
    public function create()
    {
        return view('user.products.create');
    }

    // Simpan produk baru milik user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'stock' => 'nullable|numeric',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        // Assign produk ke user yang login
        $validated['user_id'] = Auth::id();

        Product::create($validated);

        return redirect()->route('user.dashboard')->with('success', 'Product created successfully.');
    }

    // Form edit produk user
    public function edit(Product $product)
    {
        // Pastikan user hanya bisa edit produknya sendiri
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.products.edit', compact('product'));
    }

    // Update produk user
    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'stock' => 'nullable|numeric',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->route('user.products.index')->with('success', 'Product updated successfully.');
    }

    // Hapus produk user
    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('user.products.index')->with('success', 'Product deleted successfully.');
    }
}
