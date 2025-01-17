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
use App\Http\Controllers\PromoController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VolantinoPdfController;
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

Route::get('/clienti',[ClientiController::class,'index']);
Route::get('/cliente/{id}/{page}',[ClientiController::class,'show']);
Route::post('/clientiupdate/{id}',[ClientiController::class,'update']);

Route::get('/articoli',[ArticoliController::class,'index']);
Route::get('/articolo/{id}/{page}',[ArticoliController::class,'show']);
Route::get('/ricercaArticoli',[ArticoliController::class,'ricerca']);

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
Route::post('/depositoupdate/{id}',[DepositoController::class,'update']);

Route::get('/casse',[CasseController::class,'index']);
Route::post('/cassainsert',[CasseController::class,'store']);
Route::post('/cassaupdate/{id}',[CasseController::class,'update']);
Route::get('/cassadelete/{id}',[CasseController::class,'destroy']);

Route::get('/lineafidelity',[FidelityController::class,'showlinea']);
Route::post('/lineafidinsert',[FidelityController::class,'store']);
Route::post('/lineafidupdate/{id}',[FidelityController::class,'update']);
Route::get('/lineafiddelete/{id}',[FidelityController::class,'destroy']);
Route::post('generazionefidelity/{id}',[FidelityController::class,'generazione']);
Route::post('/addfidelity',[FidelityController::class,'addFidelity']);

Route::get('/fidelitycard',[FidelityController::class,'index']);
Route::post('/associafidelity',[FidelityController::class,'CollegaFidelityCliente']);
Route::post('/add_fidelity',[FidelityController::class,'store']);
Route::any('/fidelity/{id}',[FidelityController::class,'changeCard']);

Route::get('/lista_scontrini',[FidelityController::class,'listatransazioni']);

Route::get('/volantinopdf',[VolantinoPdfController::class,'index']);
Route::post('/volantinopdfinsert',[VolantinoPdfController::class,'store']);
Route::get('/volantinopdfdelete/{id}',[VolantinoPdfController::class,'destroy']);
Route::get('/volantinopdfshow/{id}',[VolantinoPdfController::class,'show']);

Route::post('promotion/filepdf',[PromotionController::class,'upload']);

Route::get('/promozioni',[PromoController::class,'index']);
Route::post('/promoupdate/{id}',[PromoController::class,'update']);
Route::post('/promoinsert',[PromoController::class,'store']);
Route::get('/promodelete/{id}',[PromoController::class,'destroy']);

Route::get('/print',function()
{
    return Pdf::loadView('pdf.document')->download();
    // return Pdf::loadFile(public_path().'/storage/filepdf.html')->download(); 
});

Route::get('/listafidelity',[FidelityController::class,'indexLista']);

Route::get('/listatransazioni',[TransactionController::class,'index']);
Route::get('/filtrilista',[TransactionController::class,'filtri']);

