<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;

class CheckoutController extends Controller
{
    // Tampilkan halaman checkout
    public function index(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $qty = $request->quantity ?? 1;

        return view('frontend.product.checkout', compact('product', 'qty'));
    }

    // Proses checkout dan simpan ke database
    public function process(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        Transaction::create([
            'user_id'      => null,
            'name'         => $request->customer_name,
            'phone'        => $request->customer_phone,
            'address'      => $request->customer_address,
            'product_name' => $product->name,
            'quantity'     => $request->quantity,
            'email'        => $request->customer_email,
            'total'        => $product->price * $request->quantity,
            'status'       => 'proses', // ✅ HARUS PROSES
        ]);


        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat!');
    }
}
