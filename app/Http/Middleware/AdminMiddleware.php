<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah login dan memiliki role admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, redirect ke halaman login admin dengan pesan error
        return redirect()->route('admin.login')->with('error', 'Akses hanya untuk admin!');
    }
}
