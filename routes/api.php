<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;

Route::get('/greeting', function () {
    return response()->json(['message' => 'Hello from Laravel API!']);
});

Route::get('/info-dashboard', [DashboardController::class, 'info']);