<?php

namespace App\Http\Controllers;

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
        // 1. Validasi data
        $data = $r->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // 2. Cek dan simpan file jika ada
        if ($r->hasFile('image')) {

            // Ambil file yang diupload
            $file = $r->file('image');

            // Ambil NAMA ASLI file
            $originalName = $file->getClientOriginalName();

            // Simpan file dengan nama aslinya ke folder 'products'
            $filePath = $file->storeAs('products', $originalName, 'public');

            // Tambahkan path gambar ke array $data
            $data['image'] = $filePath;
        }

        // 3. Simpan semua data ke database
        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk ditambahkan');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $r, Product $product)
    {
        // 1. Validasi data (gambar tidak wajib diubah)
        $data = $r->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'description' => 'nullable|string',
            // Gambar opsional saat update
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // 2. Cek apakah ada gambar baru yang diupload
        if ($r->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            // Simpan gambar baru
            $file = $r->file('image')->store('products', 'public');
            $data['image'] = $file;
        }

        // 3. Update data produk
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk diperbarui');
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
