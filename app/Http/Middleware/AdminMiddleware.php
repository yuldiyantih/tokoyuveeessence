<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login dulu');
        }

        if (Auth::user()->role == 'customer') {
            return redirect('/')->with('error', 'Tidak punya akses');
        }

        return $next($request);
    }
}
