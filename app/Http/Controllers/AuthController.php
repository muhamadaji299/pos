<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login'); // Halaman login yang sama untuk admin & kasir
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah user ada dan cocok dengan role
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Arahkan sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard.index');
            } elseif ($user->role === 'kasir') {
                return redirect()->route('kasir.dashboard.index');
            }
        }

        // Jika login gagal, kembalikan dengan pesan error
        return back()->withErrors(['email' => 'Email atau password salah!']);
    }   

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
