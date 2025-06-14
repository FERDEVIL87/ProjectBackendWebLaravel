<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Menampilkan halaman registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Memproses registrasi
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email', // Validate email
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);

        User::create([
            'username' => $request->username, // <-- TAMBAHKAN BARIS INI
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Menampilkan halaman login
    public function showLoginForm()
    {
        // Logika Captcha sederhana
        if (!session()->has('captcha')) {
            session(['captcha' => Str::random(4)]);
        }
        return view('auth.login');
    }

    // Memproses login
    public function login(Request $request)
    {
        // Langkah 1: Validasi input dari form
        // Kita validasi field 'username', bukan 'email'.
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|in:' . session('captcha'),
        ], [
            'captcha.in' => 'Captcha yang Anda masukkan salah.',
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Buat captcha baru untuk percobaan berikutnya
        session(['captcha' => Str::random(4)]);

        // Langkah 2: Coba lakukan otentikasi
        // Kita secara eksplisit memberitahu Auth::attempt untuk mencocokkan
        // kolom 'username' di database dengan input 'username' dari form.
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            // Jika berhasil, regenerate session dan arahkan ke dashboard
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // Langkah 3: Jika otentikasi gagal
        // Kembalikan ke halaman login dengan pesan error dan input username sebelumnya.
        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}