<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PcPartController;
// ... controller lain

// GANTI BLOK INI
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// DENGAN BLOK DI BAWAH INI
Route::get('/', function () {
    // Jika pengguna sudah login, arahkan ke dashboard
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    // Jika belum login, arahkan ke halaman login
    return redirect()->route('login');
})->name('home');

// Auth Routes (Biarkan seperti ini)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rute yang dilindungi (harus login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Daftarkan semua rute untuk PC Parts
    Route::resource('pc-parts', PcPartController::class);

    // Anda bisa menambahkan resource controller lain di sini nanti
    // Route::resource('laptops', LaptopController::class);
    // Route::resource('pc-rakitan', PcRakitanController::class);
});