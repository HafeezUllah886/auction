<?php

use App\Http\Controllers\AuctionsController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\WarehousesController;
use App\Http\Controllers\YardController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::resource('yards', YardController::class);
    Route::get('yards/delete/{id}', [YardController::class, 'destroy'])->name('yard.delete');
    Route::resource('auctions', AuctionsController::class);

});

