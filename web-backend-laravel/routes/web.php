<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PcPartController;
use App\Http\Controllers\CheckoutController; // <-- Added use statement
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\ConsoleAndHandheldController;
use App\Http\Controllers\LaptopController;

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
    Route::resource('pc-parts', PcPartController::class);
    Route::get('/checkouts', [CheckoutController::class, 'index'])->name('checkouts.index');
    Route::delete('/checkouts/{transaction_id}', [CheckoutController::class, 'destroy'])->name('checkouts.destroy');
    Route::get('/customer-service', [CustomerServiceController::class, 'index'])->name('customer-service.index');
    Route::resource('console-and-handhelds', ConsoleAndHandheldController::class);
    Route::resource('laptops', LaptopController::class);
});