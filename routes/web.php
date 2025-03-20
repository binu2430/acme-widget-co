<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasketController;


Route::get('/', function () {
    return view('welcome');
});

// Define a route for calculating the basket total
Route::get('/basket/total', [BasketController::class, 'calculateTotal']);
