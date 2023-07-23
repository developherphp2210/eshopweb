<?php

use App\Http\Controllers\CausalController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VatController;
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

Route::post('/customers', [CustomerController::class,'store'])->middleware(AccessToApi::class);
Route::post('/departments', [DepartmentController::class,'store'])->middleware(AccessToApi::class);
Route::post('/transactions',[TransactionController::class,'store'])->middleware(AccessToApi::class);
Route::post('/vats',[VatController::class,'store'])->middleware(AccessToApi::class);
Route::post('/causal',[CausalController::class,'store'])->middleware(AccessToApi::class);

Route::get('/chart/{type}/{date}/{id}/{shoptill}',[TransactionController::class,'show']);