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
                $cards = FidelityCard::GetFidelityList($user->id);                
                if ($cards->count() > 0 ){
                    session()->put('customer_id',$cards[0]->customer_id);
                    session()->put('user_name',$cards[0]->user_name);
                    session()->put('codice_fidelity',$cards[0]->codice_fidelity);
                    session()->put('punti_fidelity',$cards[0]->punti);
                    session()->put('testata',$cards[0]->testata);
                    session()->put('corpo',$cards[0]->corpo);
                    session()->put('user_id',$cards[0]->user_id);
                    session()->put('filepdf',$cards[0]->filepdf);                    
                    return redirect('/dashboard/fidelity');
                }else{   
                    session()->put('codice_fidelity','');                 
                    return redirect('/account/profile/3');
                }                                
                break;
            case '9':
                return view('admin.mainpage_admin')->with(['title' => 'Main Page','user' => $user]);        
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
            'email' => 'required | email',
            'password' => 'required | string'
        ]);        
        $user = User::CreateFidelity($request);
        if ($user){
            return redirect('/');
        }

        return redirect()->back()->withErrors(['errors' => "Errore nella creazione dell'utente" ]);

    }
}
