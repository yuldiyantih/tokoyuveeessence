<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Transaction;

class FrontendProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('frontend.product.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.product.show', compact('product'));
    }

    /**
     * BUY NOW (FRONTEND)
     */
    public function buyNow(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $qty = max((int) $request->quantity, 1);

        session()->put('buy_now', [
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => $product->price,
            'quantity'   => $qty,
            'total'      => $product->price * $qty,
            'image'      => $product->image ?? null,
        ]);

        if (!Auth::check()) {
            session()->put('url.intended', route('customer.checkout.index'));
            return redirect()->route('login');
        }

        // 🔥 HARUS KE CHECKOUT, BUKAN CART
        return redirect()->route('customer.checkout.index');
    }
}
