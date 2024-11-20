<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DashboardController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/sales-report', [DashboardController::class, 'sales']);
Route::get('/top-seller', [DashboardController::class, 'topSeller']);
