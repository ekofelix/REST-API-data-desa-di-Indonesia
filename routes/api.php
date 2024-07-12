<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvincesController;
use App\Http\Controllers\RegenciesController;
use App\Http\Controllers\DistrictsController;
use App\Http\Controllers\VillagesController;

// Route::prefix('api')->group(function () {
    Route::resource('provinces', ProvincesController::class);
    Route::resource('regencies', RegenciesController::class);
    Route::resource('districts', DistrictsController::class);
    Route::resource('villages', VillagesController::class);
// });
