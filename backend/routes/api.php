<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\FuelRecordController;
use App\Http\Controllers\AuthController;

// Route::apiResource('vehicles', VehicleController::class);
// Route::apiResource('fuel-records', FuelRecordController::class);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/fuel-records', [FuelRecordController::class, 'store']);
Route::get('/dashboard-stats', [FuelRecordController::class, 'getDashboardStats']);
Route::get('/check-fuel', [FuelRecordController::class, 'checkStatus']);

// Example protected route
Route::middleware('auth:sanctum')->get('/user-profile', function (Request $request) {
    return $request->user();
});
