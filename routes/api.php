<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/balance/{id}', App\Http\Controllers\API\BalanceController::class)->name('balance');
Route::post('/deposit', App\Http\Controllers\API\Deposit\StoreController::class)->name('deposit');
Route::post('/withdraw', App\Http\Controllers\API\Withdraw\StoreController::class)->name('withdraw');
Route::post('/transfer', App\Http\Controllers\API\Transfer\StoreController::class)->name('transfer');