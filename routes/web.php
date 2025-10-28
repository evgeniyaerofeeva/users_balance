<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('balance.index');
})->name('balance.index');

Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');

Route::get('/deposit/create', App\Http\Controllers\Deposit\CreateController::class)->name('deposit.create');
Route::get('/withdraw/create', App\Http\Controllers\Withdraw\CreateController::class)->name('withdraw.create');
Route::get('/transfer/create', App\Http\Controllers\Transfer\CreateController::class)->name('transfer.create');
Route::get('/balance/users', [App\Http\Controllers\BalanceController::class, 'index'])->name('balance.users');
Route::get('/balance/users/{id}', [App\Http\Controllers\BalanceController::class, 'show'])->name('balance.show');