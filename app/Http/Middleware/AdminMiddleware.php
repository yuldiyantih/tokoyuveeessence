<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Belum login → ke login admin
        if (!Auth::check()) {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Silakan login sebagai admin');
        }

        // Bukan admin / super admin → tolak
        if (!in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            return redirect('/')
                ->with('error', 'Tidak punya akses ke halaman admin');
        }

        return $next($request);
    }
}
