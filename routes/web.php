<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\RateController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/destinos', [ApiController::class, 'getRegions']);
Route::post('/tarifas', [ApiController::class, 'getRates']);

Route::get('/destinos', [DestinationController::class, 'index'])->name('destinos.index');
Route::post('/destinos', [DestinationController::class, 'store'])->name('destinos.store');

Route::get('/cart', [CartController::class, 'index'])->name('carrito.index');
Route::post('/cart/store', [CartController::class, 'store'])->name('carrito.store');

Route::get('/rate', [RateController::class, 'index'])->name('rate.index');
Route::post('/rate/store', [RateController::class, 'store'])->name('rate.store');
Route::get('/rates/history', [RateController::class, 'showHistory'])->name('rates.history');

Route::get('/admin', function () {
    if (!Gate::allows('manage-system')) {
        abort(403, 'Acceso denegado');
    }
    return view('admin.dashboard');
});