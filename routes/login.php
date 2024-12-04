<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AccessToWeb;
use App\Http\Middleware\AccessToWebFid;
use App\Http\Middleware\Authenticate;
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

Route::any('/dologin',[LoginController::class,'login'])->middleware(AccessToWeb::class);
Route::post('/doregister_user',[LoginController::class,'insert']);
Route::post('/dopassword_recovery',[LoginController::class,'recovery']);
Route::any('/dologinfid',[LoginController::class,'login'])->middleware(AccessToWebFid::class);

Route::get('/',function(){
    return view('login.login')->with(['title' => 'Accesso Utenti']);
})->name('login');

Route::get('/fidelity',function(){
    return view('login.loginFidelity')->with(['title' => 'Accesso Clienti Fidelity']);
})->name('login');

Route::get('/registrazione',function(){
    return view('users.fidelity.register')->with(['title' => 'Pagina di registrazione']);
});

Route::get('/password_recovery',function(){
    $notification = '';
    return view('login.recovery')->with(['title' => 'Recupera Password','notification' => $notification]);
});

Route::post('/doregister_fidelity',[LoginController::class,'insert_fidelity']);
Route::get('/logout',[LoginController::class,'logout']);
