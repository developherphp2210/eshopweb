<?php

use App\Http\Controllers\ArticoliController;
use App\Http\Controllers\CasseController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\IvaController;
use App\Http\Controllers\RepartiController;
use App\Http\Controllers\CassieriController;
use App\Http\Controllers\CausaliController;
use App\Http\Controllers\ClientiController;
use App\Http\Controllers\DepositoController;
use App\Http\Controllers\FidelityController;
use App\Http\Controllers\ProfiloController;
use App\Http\Controllers\ScontiController;
use App\Http\Controllers\PagamentiController;
use App\Http\Controllers\VendutoController;
use App\Http\Middleware\AccessToApi;
use App\Models\Codean;
use App\Models\EListino;
use App\Models\RListino;
use App\Models\TListino;
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


Route::get('iva/{id}',[IvaController::class,'show']);
Route::get('reparto/{id}',[RepartiController::class,'show']);
Route::get('cassiere/{id}',[CassieriController::class,'show']);
Route::get('profilo/{id}',[ProfiloController::class,'show']);
Route::get('sconto/{id}',[ScontiController::class,'show']);
Route::get('pagamento/{id}',[PagamentiController::class,'show']);
Route::get('causale/{id}',[CausaliController::class,'show']);
Route::get('lineafidelity/{id}',[FidelityController::class,'show']);
Route::get('deposito/{id}',[DepositoController::class,'show']);
Route::get('cassa/{id}',[CasseController::class,'show']);

Route::get('check/{cassa}/{deposito}',[CasseController::class,'check']);
Route::get('casse/{idcassa}',[CasseController::class,'indexCasse']);
Route::get('profili/{idcassa}',[ProfiloController::class,'indexCasse']);
Route::get('cassieri/{idcassa}',[CassieriController::class,'indexCasse']);
Route::get('aliquote/{idcassa}',[IvaController::class,'indexCasse']);
Route::get('reparti/{idcassa}',[RepartiController::class,'indexCasse']);
Route::get('causali/{idcassa}',[CausaliController::class,'indexCasse']);
Route::get('pagamenti/{idcassa}',[PagamentiController::class,'indexCasse']);
Route::get('sconti/{idcassa}',[ScontiController::class,'indexCasse']);
Route::get('tlistini/{idcassa}',function($idcassa){
    $result = [];
    try {
        $result['status'] = '200';
        $result['result'] = 'true';
        $result['items'] = TListino::GetListCasse($idcassa);;    
    } catch (\Throwable $th) {
        $result['status'] = '400';
        $result['result'] = 'false';
        $result['error'] = $th->getMessage();
    }                
    return $result;
});
Route::get('articoli/{idcassa}',[ArticoliController::class,'indexCasse']);
Route::get('rlistini/{idcassa}',function($idcassa){
    $result = [];
    try {
        $result['status'] = '200';
        $result['result'] = 'true';
        $result['items'] = RListino::GetListCasse($idcassa);;    
    } catch (\Throwable $th) {
        $result['status'] = '400';
        $result['result'] = 'false';
        $result['error'] = $th->getMessage();
    }                
    return $result;
});
Route::get('barcode/{idcassa}',function($idcassa){
    $result = [];
    try {
        $result['status'] = '200';
        $result['result'] = 'true';
        $result['items'] = Codean::GetListCasse($idcassa);
    } catch (\Throwable $th) {
        $result['status'] = '400';
        $result['result'] = 'false';
        $result['error'] = $th->getMessage();
    }                
    return $result;
});
Route::get('elistini/{idcassa}',function($idcassa){
    $result = [];
    try {
        $result['status'] = '200';
        $result['result'] = 'true';
        $result['items'] = EListino::GetListCasse($idcassa);;    
    } catch (\Throwable $th) {
        $result['status'] = '400';
        $result['result'] = 'false';
        $result['error'] = $th->getMessage();
    }                
    return $result;
});
Route::get('clienti/{idcassa}',[ClientiController::class,'indexCasse']);
Route::get('fidelity/{idcassa}',[FidelityController::class,'indexCasse']);
Route::get('lineafidelity/{idcassa}',[FidelityController::class,'indexLineaCasse']);
Route::get('closecheck/{idcassa}',[CasseController::class,'closeRequest']);

Route::post('venduto',[VendutoController::class,'store']);

Route::get('/chart/{type}/{date}/{shoptill}',[TransactionController::class,'show']);
Route::post('/annulloscontrino/{id}/{operid}',[TransactionController::class,'annulloScontrino']);

Route::get('/listatransazione/{cassa}/{deposito}/{data}',[VendutoController::class,'show']);