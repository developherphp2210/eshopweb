<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FidelityController;
use App\Http\Controllers\VatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/customers',[CustomerController::class,'index']);
Route::get('/customer/{id}/{page}',[CustomerController::class,'show']);
Route::get('/departments',[DepartmentController::class,'index']);
Route::get('/vats',[ VatController::class,'index']);
Route::get('/articles',[ArticleController::class,'index']);
Route::get('/article/{id}/{page}',[ArticleController::class,'show']);

Route::post('/add_fidelity',[FidelityController::class,'store']);
Route::any('/fidelity/{id}',[FidelityController::class,'changeCard']);

Route::get('receipt_list',[FidelityController::class,'index']);
Route::get('receipt/{id}',[FidelityController::class,'show']);
Route::get('receiptuser/{id}',[CustomerController::class,'receipt']);


