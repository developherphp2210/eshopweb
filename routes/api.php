<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\IvaController;
use App\Http\Controllers\RepartiController;
use App\Http\Controllers\CassieriController;
use App\Http\Controllers\ProfiloController;
use App\Http\Middleware\AccessToApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('iva/{id}',[IvaController::class,'show']);
Route::get('reparto/{id}',[RepartiController::class,'show']);
Route::get('cassiere/{id}',[CassieriController::class,'show']);
Route::get('profilo/{id}',[ProfiloController::class,'show']);
Route::get('/chart/{type}/{date}/{id}/{shoptill}',[TransactionController::class,'show']);