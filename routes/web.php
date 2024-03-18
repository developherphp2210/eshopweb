<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticoliController;
use App\Http\Controllers\ClientiController;
use App\Http\Controllers\RepartiController;
use App\Http\Controllers\CassieriController;
use App\Http\Controllers\ProfiloController;
use App\Http\Controllers\FidelityController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\IvaController;
use Barryvdh\DomPDF\Facade\Pdf;
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

Route::get('/clienti',[ClientiController::class,'index']);
Route::get('/clienti/{id}/{page}',[ClientiController::class,'show']);

Route::get('/articoli',[ArticoliController::class,'index']);
Route::get('/articoli/{id}/{page}',[ArticoliController::class,'show']);

Route::get('/reparti',[RepartiController::class,'index']);
Route::post('/repartoinsert',[RepartiController::class,'store']);
Route::post('/repartoupdate/{id}',[RepartiController::class,'update']);
Route::get('/repartodelete/{id}',[RepartiController::class,'destroy']);

Route::get('/iva',[IvaController::class,'index']);
Route::post('/ivaupdate/{id}',[IvaController::class,'update']);
Route::post('/ivainsert',[IvaController::class,'store']);
Route::get('/ivadelete/{id}',[IvaController::class,'destroy']);

Route::get('/cassieri',[CassieriController::class,'index']);
Route::post('/cassiereinsert',[CassieriController::class,'store']);
Route::post('/cassiereupdate/{id}',[CassieriController::class,'update']);
Route::get('/cassieredelete/{id}',[CassieriController::class,'destroy']);

Route::get('/profili',[ProfiloController::class,'index']);
Route::post('/profiloinsert',[ProfiloController::class,'store']);
Route::post('/profiloupdate/{id}',[ProfiloController::class,'update']);
Route::get('/profilodelete/{id}',[ProfiloController::class,'destroy']);

Route::post('/add_fidelity',[FidelityController::class,'store']);
Route::any('/fidelity/{id}',[FidelityController::class,'changeCard']);

Route::get('receipt_list',[FidelityController::class,'index']);
Route::get('receipt/{id}',[FidelityController::class,'show']);
Route::get('receiptuser/{id}',[CustomerController::class,'receipt']);

Route::get('/promotions',[PromotionController::class,'index']);
Route::post('promotion/filepdf',[PromotionController::class,'upload']);

Route::get('/print',function()
{
    return Pdf::loadView('pdf.document')->download();
    // return Pdf::loadFile(public_path().'/storage/filepdf.html')->download(); 
});

