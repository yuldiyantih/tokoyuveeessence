<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\ProfileCustomer;
use App\Models\Transaction;
use App\Models\Product;

class CheckoutController extends Controller
{
    /* ===============================
     | CHECKOUT PAGE
     =============================== */
    public function index(Request $request)
    {
        $user = Auth::user();

        // 🔥 TAMBAHAN: JIKA DARI BUY NOW (PAKAI SESSION)
        if (session()->has('buy_now')) {
            $checkout = session('buy_now');

            $profile = ProfileCustomer::where('user_id', $user->id)->first();

            if (!$profile) {
                return redirect()
                    ->route('profile.index')
                    ->with('error', 'Lengkapi profil terlebih dahulu');
            }

            // bentuk seperti cartItems supaya view tidak perlu diubah
            $cartItems = collect([
                (object) [
                    'product' => (object) [
                        'name'  => $checkout['name'],
                        'price' => $checkout['price'],
                        'image' => $checkout['image'] ?? null,
                    ],
                    'quantity' => $checkout['quantity'],
                ]
            ]);

            $total = $checkout['total'];

            return view('frontend.checkout.index', compact(
                'profile',
                'cartItems',
                'total'
            ));
        }

        // 🔽 ===== ALUR LAMA DARI CART (TIDAK DIUBAH) ===== 🔽

        // VALIDASI CHECKBOX
        if (!$request->has('cart_ids')) {
            return redirect()
                ->route('customer.cart.index')
                ->with('error', 'Pilih produk yang ingin dibeli');
        }

        $profile = ProfileCustomer::where('user_id', $user->id)->first();

        if (!$profile) {
            return redirect()
                ->route('profile.index')
                ->with('error', 'Lengkapi profil terlebih dahulu');
        }

        // 🔥 AMBIL CART YANG DIPILIH SAJA
        $cartItems = Cart::with('product')
            ->where('user_id', $user->id)
            ->whereIn('id', $request->cart_ids)
            ->get();

        if ($cartItems->count() === 0) {
            return redirect()
                ->route('customer.cart.index')
                ->with('error', 'Produk tidak ditemukan');
        }

        $total = $cartItems->sum(
            fn($item) =>
            $item->product->price * $item->quantity
        );

        return view('frontend.checkout.index', compact(
            'profile',
            'cartItems',
            'total'
        ));
    }

    /* ===============================
     | PROCESS CHECKOUT
     =============================== */
    public function process(Request $request)
    {
        $user = Auth::user();
        $profile = ProfileCustomer::where('user_id', $user->id)->first();

        DB::beginTransaction();

        try {

            // 🔥 ========== ALUR BUY NOW ==========
            if (session()->has('buy_now')) {
                $checkout = session('buy_now');

                Transaction::create([
                    'user_id'      => $user->id,
                    'name'         => $profile->name,
                    'phone'        => $profile->phone,
                    'email'        => $user->email,
                    'address'      => $profile->address,
                    'product_name' => $checkout['name'],
                    'quantity'     => $checkout['quantity'],
                    'total'        => $checkout['total'],
                    'status'       => 'proses',
                ]);

                // hapus session buy now
                session()->forget('buy_now');

                DB::commit();

                return redirect()
                    ->route('customer.checkout.success')
                    ->with('success', 'Pesanan Anda sedang kami siapkan');
            }

            // 🔥 ========== ALUR DARI CART ==========
            $request->validate([
                'cart_ids'       => 'required|array',
                'payment_method' => 'required',
                'payment_proof'  => 'required|image|max:5120',
            ]);

            $cartItems = Cart::with('product')
                ->where('user_id', $user->id)
                ->whereIn('id', $request->cart_ids)
                ->get();

            foreach ($cartItems as $item) {
                Transaction::create([
                    'user_id'      => $user->id,
                    'name'         => $profile->name,
                    'phone'        => $profile->phone,
                    'email'        => $user->email,
                    'address'      => $profile->address,
                    'product_name' => $item->product->name,
                    'quantity'     => $item->quantity,
                    'total'        => $item->product->price * $item->quantity,
                    'status'       => 'proses',
                ]);
            }

            // hapus cart yang dibeli
            Cart::whereIn('id', $request->cart_ids)->delete();

            DB::commit();

            return redirect()
                ->route('customer.checkout.success')
                ->with('success', 'Pesanan Anda sedang kami siapkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout gagal');
        }
    }
}
