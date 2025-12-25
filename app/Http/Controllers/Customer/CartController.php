<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /* ===============================
     |  CART INDEX
     =============================== */
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // TOTAL JANGAN DISIMPAN DI DB
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('frontend.cart.index', compact('cartItems', 'total'));
    }

    /* ===============================
     |  ADD TO CART
     =============================== */
    public function add(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $product = Product::findOrFail($id);
        $qty = max((int) $request->quantity, 1);

        $cart = Cart::firstOrCreate(
            [
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'quantity' => 0
            ]
        );

        $cart->quantity += $qty;
        $cart->save();

        return redirect()
            ->route('customer.cart.index')
            ->with('success', 'Produk ditambahkan ke keranjang');
    }

    /* ===============================
     |  UPDATE QTY (+ / -)
     =============================== */
    public function update(Request $request, $id)
    {
        // 🔥 FIX UTAMA: pakai CART ID
        $cart = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($request->action === 'increase') {
            $cart->quantity++;
        }

        if ($request->action === 'decrease' && $cart->quantity > 1) {
            $cart->quantity--;
        }

        $cart->save();

        return back();
    }

    /* ===============================
     |  REMOVE ITEM
     =============================== */
    public function remove($id)
    {
        Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Produk dihapus dari keranjang');
    }
}
