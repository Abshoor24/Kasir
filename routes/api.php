<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

Route::get('/greeting', function () {
    return response()->json(['message' => 'Hello from Laravel API!']);
});

Route::middleware('auth')->get('/info-dashboard', [DashboardController::class, 'info']);

