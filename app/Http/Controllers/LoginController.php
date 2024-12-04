<?php

namespace App\Http\Controllers;

use App\Models\FidelityCard;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    
    public function login(Request $request){    
            
        $user = session('user');            
        switch ($user->type) {
            case '0':                
                return redirect('/dashboard');                
                break;            
            case '1':                
                                   
                return redirect('/dashboard/fidelity');
                                               
                break;            
        }
        
        
    }

    public function recovery(Request $request){
        $notification = User::RecoveryPassword($request->email);
        return view('login.recovery')->with(['title' => 'Recupera Password','notification' => $notification]);
    }

    public function insert(Request $request){

        $valid = $request->validate([
            'user_name' => 'required | string',
            'email' => 'required | email'            
        ]);
        
        $user = User::CreateUser($request);        
        if ($user){
            Settings::CreateSettings($user->id);
            return redirect()->back();
        }

        return redirect()->back()->withErrors(['errors' => "Errore nella creazione dell'utente" ]);

    }

    public function logout(Request $request){                
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();
        return redirect('/');                
    }

    public function insert_fidelity(Request $request){
       

        $valid = $request->validate([
            'user_name' => 'required | string',
            // 'email' => 'required | email',
            'password' => 'required | string'
        ]);   
        
            $user = User::CreateFidelity($request);
            if ($user){
                $request->session()->regenerate();                              
                $user = User::AccessUser($request);                                                              
                $request->session()->put('user',$user);
                return redirect('/dashboard');
            }
        
        return redirect()->back()->withErrors(['errors' => "Errore nella creazione dell'utente" ]);

    }
}
