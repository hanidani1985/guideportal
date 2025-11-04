<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientViewController;
use App\Http\Controllers\TourGuideController;

// Public client routes
Route::get('/', [ClientViewController::class, 'index'])->name('home');
Route::get('/locations', [ClientViewController::class, 'index'])->name('client.locations.index');
Route::get('/locations/{location}', [ClientViewController::class, 'show'])->name('client.locations.show');
Route::get('/map', [ClientViewController::class, 'map'])->name('client.map');

// Tour guide routes (requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/tourguide', [TourGuideController::class, 'index'])->name('tourguide.locations.index');
    Route::get('/tourguide/locations/{location}', [TourGuideController::class, 'show'])->name('tourguide.locations.show');
});
