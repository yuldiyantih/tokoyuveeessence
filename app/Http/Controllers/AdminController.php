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
     * PROSES LOGIN ADMIN
     */
    public function authenticate(Request $request)
    {
        // Validasi input (backend safety)
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika email tidak ditemukan ATAU password salah
        if (
            !$user ||
            !Hash::check($request->password, $user->password)
        ) {
            return back()->with('login_error', 'Login failed. Invalid email or password.');
        }

        // Jika bukan admin
        if ($user->role === 'customer') {
            return back()->with('login_error', 'Access denied. Admin only.');
        }

        // Login user
        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }

    /**
     * DASHBOARD ADMIN
     */
    public function index()
    {
        $products           = Product::latest()->take(20)->get();
        $usersCount         = User::count();
        $transactionsCount  = Transaction::count();
        $transactionsLatest = Transaction::latest()->take(10)->get();

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
