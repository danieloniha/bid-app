<?php

use App\Http\Controllers\BidController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/bid', function () {
//     return view('bid');
// });

Route::get('/bids', [BidController::class, 'index'])->name('bids');

Route::get('/bids/create', [BidController::class, 'category'])->name('bids.create');

Route::post('/bids/store', [BidController::class, 'store'])->name('bids.store');

