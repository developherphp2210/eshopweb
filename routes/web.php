<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticoliController;
use App\Http\Controllers\CasseController;
use App\Http\Controllers\ClientiController;
use App\Http\Controllers\RepartiController;
use App\Http\Controllers\CassieriController;
use App\Http\Controllers\ProfiloController;
use App\Http\Controllers\ScontiController;
use App\Http\Controllers\PagamentiController;
use App\Http\Controllers\FidelityController;
use App\Http\Controllers\CausaliController;
use App\Http\Controllers\DepositoController;
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

Route::get('/sconti',[ScontiController::class,'index']);
Route::post('/scontoinsert',[ScontiController::class,'store']);
Route::post('/scontoupdate/{id}',[ScontiController::class,'update']);
Route::get('/scontodelete/{id}',[ScontiController::class,'destroy']);

Route::get('/pagamenti',[PagamentiController::class,'index']);
Route::post('/pagamentoinsert',[PagamentiController::class,'store']);
Route::post('/pagamentoupdate/{id}',[PagamentiController::class,'update']);
Route::get('/pagamentodelete/{id}',[PagamentiController::class,'destroy']);

Route::get('/causali',[CausaliController::class,'index']);
Route::post('/causaleinsert',[CausaliController::class,'store']);
Route::post('/causaleupdate/{id}',[CausaliController::class,'update']);
Route::get('/causaledelete/{id}',[CausaliController::class,'destroy']);

Route::get('/depositi',[DepositoController::class,'index']);

Route::get('/casse',[CasseController::class,'index']);
Route::post('/cassainsert',[CasseController::class,'store']);
Route::post('/cassaupdate/{id}',[CasseController::class,'update']);
Route::get('/cassadelete/{id}',[CasseController::class,'destroy']);

Route::post('/add_fidelity',[FidelityController::class,'store']);
Route::any('/fidelity/{id}',[FidelityController::class,'changeCard']);

Route::get('receipt_list',[FidelityController::class,'index']);
Route::get('receipt/{id}',[FidelityController::class,'show']);
// Route::get('receiptuser/{id}',[CustomerController::class,'receipt']);

Route::get('/promotions',[PromotionController::class,'index']);
Route::post('promotion/filepdf',[PromotionController::class,'upload']);

Route::get('/print',function()
{
    return Pdf::loadView('pdf.document')->download();
    // return Pdf::loadFile(public_path().'/storage/filepdf.html')->download(); 
});

