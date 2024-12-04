<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FidelityController;
use App\Http\Controllers\SettingController;
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
Route::get('/dashboard',[AccountController::class,'dash'])->name('dashboard');
Route::get('/dashboarddeposito/{data}/{id_deposito}',[AccountController::class,'deposito'])->name('dashboardshop');
Route::get('/dashboardcassa/{data}/{id_cassa}',[AccountController::class,'cassa'])->name('dashboardtill');
Route::get('/dashboard/fidelity',[AccountController::class,'fidelity']);
// Route::get('/dashboard_admin',[AdminController::class,'main']);


Route::get('/account/profile/{page}',[AccountController::class,'show']);
Route::get('/account/settings',[SettingController::class,'index']);

Route::post('/saveaccount/{page}',[AccountController::class,'save']);
Route::post('/savesetting',[SettingController::class,'store']);
