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
     * HALAMAN LOGIN
     */
    public function login()
    {
        return view('admin.auth.login');
    }

    /**
     * PROSES LOGIN (ADMIN, SUPER_ADMIN, CUSTOMER)
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('login_error', 'Login failed. Invalid email or password.');
        }

        Auth::login($user);

        // 🔥 REDIRECT PAKSA BERDASARKAN ROLE
        switch ($user->role) {
            case 'super_admin':
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'customer':
                return redirect()->route('home');

            default:
                Auth::logout();
                return redirect()->route('login')
                    ->with('login_error', 'Role tidak dikenali');
        }
    }
}
