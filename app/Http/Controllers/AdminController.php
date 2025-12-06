<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * HALAMAN LOGIN ADMIN
     */
    public function login()
    {
        return view('admin.auth.login');
    }


    /**
     * PROSES LOGIN (TANPA HASH)
     */
    public function authenticate(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Cek user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        // Cek password biasa (TANPA bcrypt)
        if (!(Hash::check($request->password, $user->password))) {
            return back()->with('error', 'Password salah.');
        }

        // Cek apakah role admin
        if ($user->role == 'customer') {
            return back()->with('error', 'Akses ditolak. Anda bukan admin.');
        }

        // Login manual
        Auth::login($user);
        // dd(Auth::user());

        return redirect()->route('admin.dashboard');
    }


    /**
     * DASHBOARD ADMIN
     */
    public function index()
    {
        $products            = Product::latest()->take(8)->get();
        $usersCount          = User::count();
        $transactionsCount   = Transaction::count();
        $transactionsLatest  = Transaction::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'products',
            'usersCount',
            'transactionsCount',
            'transactionsLatest'
        ));
    }


    /**
     * LOGOUT ADMIN
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
