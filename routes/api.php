<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login',    [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',    [AuthController::class, 'logout']);
    
    Route::get('/s3-images', [ImageController::class, 'listImages']);
    
    
    Route::get('/themes/{theme_id}', [ThemeController::class, 'getImages']);
    Route::get('/themes', [ThemeController::class, 'getAllThemes']);
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});














