<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthCustomerController extends Controller
{
    /**
     * =========================
     * LOGIN CUSTOMER
     * =========================
     * Pakai VIEW YANG SAMA dengan admin
     */
    public function login()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->with('login_error', 'Email atau password salah');
        }

        // Kalau admin/superadmin login lewat sini → arahkan ke backend
        if (in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            return redirect()->route('admin.dashboard');
        }

        // Customer
        return redirect()->route('home');
    }

    /**
     * =========================
     * REGISTER CUSTOMER
     * =========================
     * Untuk user yang BELUM punya akun
     */
    public function showRegister()
    {
        return view('frontend.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'customer', // ✅ otomatis customer
        ]);

        Auth::login($user);

        return redirect()->route('home')
            ->with('success', 'Berhasil daftar, selamat datang!');
    }

    /**
     * =========================
     * LOGOUT CUSTOMER
     * =========================
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
