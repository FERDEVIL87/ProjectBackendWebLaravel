<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HardwareController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\Api\ConsoleAndHandheldController;
use App\Http\Controllers\Api\LaptopController;
use App\Http\Controllers\Api\TechNewsController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\PcRakitanController;
use App\Http\Controllers\Api\SimulasiController;

Route::get('/hardware', [HardwareController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'store']);
Route::get('/console-and-handhelds', [ConsoleAndHandheldController::class, 'index']);
Route::get('/laptops', [LaptopController::class, 'index']);
Route::post('/customer-service', [CustomerServiceController::class, 'store']);
Route::get('/tech-news', [TechNewsController::class, 'index']);
Route::get('/banners', [BannerController::class, 'index']);
Route::get('/pc-rakitans', [PcRakitanController::class, 'index']);
Route::get('/simulasi-parts', [SimulasiController::class, 'getPcParts']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});