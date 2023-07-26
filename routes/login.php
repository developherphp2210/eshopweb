<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AccessToWeb;
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


// Route::get('/login_user',function(){
//     return view('login.login_user')->with(['title' => 'Login User Page']);
// })->name('login_user');

Route::any('/dologin',[LoginController::class,'login'])->middleware(AccessToWeb::class);
Route::get('/register_user',[AdminController::class,'insert']);
Route::post('/doregister_user',[LoginController::class,'insert']);


Route::get('/',function(){
    return view('login.login')->with(['title' => 'Login Page']);
})->name('login');
Route::get('/register_fidelity',function(){
    return view('fidelity.register')->with(['title' => 'Pagina registrazione']);
});
Route::post('/doregister_fidelity',[LoginController::class,'insert_fidelity']);
Route::get('/logout',[LoginController::class,'logout']);
