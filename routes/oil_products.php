<?php

use App\Http\Controllers\OilProductsController;
use App\Http\Middleware\adminCheck;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', adminCheck::class)->group(function () {

   Route::resource('oil_products', OilProductsController::class);

});

