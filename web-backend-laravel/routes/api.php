<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HardwareController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\Api\ConsoleAndHandheldController;
use App\Http\Controllers\Api\LaptopController;

Route::get('/hardware', [HardwareController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'store']);
Route::get('/console-and-handhelds', [ConsoleAndHandheldController::class, 'index']);
Route::get('/laptops', [LaptopController::class, 'index']);
Route::post('/customer-service', [CustomerServiceController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});