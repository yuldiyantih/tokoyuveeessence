<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ✅ TAMPILKAN FORM LOGIN (SATU VIEW)
    public function login()
    {
        return view('admin.auth.login');
    }

    // ✅ PROSES LOGIN ADMIN
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->with('login_error', 'Email atau password salah');
        }

        $user = Auth::user();

        // ❌ BLOK CUSTOMER
        if (!in_array($user->role, ['admin', 'super_admin'])) {
            Auth::logout();
            return back()->with('login_error', 'Bukan akun admin');
        }

        return redirect()->route('admin.dashboard');
    }

    // ✅ LOGOUT ADMIN
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
