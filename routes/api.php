<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\HotelController;
use App\Http\Controllers\API\Room\RoomController;
use App\Http\Controllers\API\Room\RoomTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Guest routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Auth routes
Route::middleware('auth:sanctum')->group(function(){
    Route::post('/me', [AuthController::class, 'me']);
    // Hotel routes
    Route::apiResource('hotels', HotelController::class);
    // Room routes
    Route::apiResource('rooms', RoomController::class);
    // RoomTypes routes
    Route::apiResource('room-types', RoomTypeController::class);
});
