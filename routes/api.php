<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DataController;
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

Route::get('/login', [AuthController::class, 'login']);
Route::get('/pemeriksaan', [DataController::class, 'checkup']);
Route::get('/profile', [DataController::class, 'profile']);
Route::get('/category', [DataController::class, 'categoryCheckup']);
Route::get('/content', [DataController::class, 'content']);

// Route::middleware('auth:sanctum')->get('/pemeriksaan', [DataController::class, 'checkup']);
// Route::middleware('auth:sanctum')->get('/profile', [DataController::class, 'profile']);

// Route::middleware('auth:sanctum')->name('profile.')->group(function () {
//     Route::get('/profile', [AuthController::class, 'login']);
// });
