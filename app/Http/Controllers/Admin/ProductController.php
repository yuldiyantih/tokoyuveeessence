<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Method untuk menyimpan produk baru
     */
    public function store(Request $r)
    {

        $data = $r->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($r->hasFile('image')) {

            $file = $r->file('image');
            $originalName = $file->getClientOriginalName();

            // Jika file dengan nama sama sudah ada → rename otomatis
            $finalName = time() . '-' . $originalName;

            $filePath = $file->storeAs('products', $finalName, 'public');

            $data['image'] = $filePath;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk ditambahkan');
    }


    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $r, Product $product)
    {
        $data = $r->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($r->hasFile('image')) {

            // Hapus gambar lama jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $file = $r->file('image');
            $originalName = $file->getClientOriginalName();

            // Rename untuk mencegah bentrok
            $finalName = time() . '-' . $originalName;

            $filePath = $file->storeAs('products', $finalName, 'public');

            $data['image'] = $filePath;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk diperbarui');
    }


    public function destroy(Product $product)
    {
        // Hapus gambar dari storage sebelum menghapus data
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();
        return back()->with('success', 'Produk dihapus');
    }
}
