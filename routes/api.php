<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LokasiController;
use App\Http\Controllers\Api\MutasiController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\ProdukLokasiController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('produk', ProdukController::class);
    Route::resource('/produk', ProdukController::class);
    Route::resource('/lokasi', LokasiController::class);
    Route::resource('/produklokasi', ProdukLokasiController::class);
    Route::resource('/mutasi', MutasiController::class);
    Route::get('/mutasi/history/produk/{produkId}', [MutasiController::class, 'historyByProduk']);
    Route::get('/mutasi/history/user/{userId}', [MutasiController::class, 'historyByUser']);
    Route::get('/user', [AuthController::class, 'index']);


    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
