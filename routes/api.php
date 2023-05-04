<?php

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


Route::post('/login', [\App\Http\Controllers\API\Auth\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [\App\Http\Controllers\API\Auth\AuthController::class, 'logout']);

    Route::get('/consultations', [\App\Http\Controllers\API\Society\IndexController::class, 'consultations']);
    Route::post('/consultations', [\App\Http\Controllers\API\Society\IndexController::class, 'storeConsultation']);

    Route::get('/spots', [\App\Http\Controllers\API\Society\IndexController::class, 'spots']);
    Route::get('/spot/{id}/{date}', [\App\Http\Controllers\API\Society\IndexController::class, 'spot']);

    Route::get('/vaccinations', [\App\Http\Controllers\API\Society\IndexController::class, 'vaccinations']);
    Route::post('/vaccinations', [\App\Http\Controllers\API\Society\IndexController::class, 'storeVaccination']);
});

