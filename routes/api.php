<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\LotController;
// use App\Http\Controllers\MediaController;
// use App\Http\Controllers\ProfileController;

// /*
// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register API routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | is assigned the "api" middleware group. Enjoy building your API!
// |
// */

// Route::group(['prefix' => 'auth'], function() {

//     Route::post('/registration', [AuthController::class, 'register']);
//     Route::post('/login', [AuthController::class, 'login']);

//     Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
// });

// Route::middleware('auth:sanctum')->get('/profile', [ProfileController::class, 'index']);

// Route::group(['prefix' => 'lot'], function() {

//     Route::get('/get', [LotController::class, 'index'])->withoutMiddleware('auth:sancum');
//     Route::get('get/{id}', [LotController::class, 'show'])->withoutMiddleware('auth:sanctum');
        
//     Route::middleware('auth:sanctum')->post('/create', [LotController::class, 'store']);
//     Route::middleware('auth:sanctum')->put('/update/{id}', [LotController::class, 'update']);
//     Route::middleware('auth:sanctum')->delete('/delete/{id}', [LotController::class, 'destroy']);
// });

// Route::group(['prefix' => 'media'], function() {

//     Route::middleware('auth:sanctum')->post('/lot/{id}', [MediaController::class, 'mediaLot']);
// });