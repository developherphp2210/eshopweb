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
        // $data = new DateTime('now');      
        switch ($user->type) {
            case '0':
                // $total['sessionid'] = $user->id;
                // $total['date'] = $data->format('Y-m-d');
                // // calcolo importo giornaliero                  
                // $total['day'] = TransactionHeader::TotalDay($user->id,$data,0,0);                
                // // calcolo importi settimanali
                // $total['week'] = TransactionHeader::TotalWeek($user->id,$data,0,0);
                // // calcolo importo mensile
                // $total['month'] = TransactionHeader::TotalMonth($user->id,$data,0,0);
                // // calcolo totale casse
                // $total['tills'] = TransactionHeader::TotalTills($user->id,$data,0); 
                // $total['name'] = ''; 
                // $total['tillid'] = '';
                // $total['shopid'] = '';       
                return redirect('/dashboard');                
                break;            
            case '1':                
                $cards = FidelityCard::GetFidelityList($user->id);
                if ($cards){
                    session()->put('customer_id',$cards[0]->customer_id);
                    session()->put('user_name',$cards[0]->user_name);
                    session()->put('codice_fidelity',$cards[0]->codice_fidelity);
                    session()->put('punti_fidelity',$cards[0]->punti);
                    session()->put('testata',$cards[0]->testata);
                    session()->put('corpo',$cards[0]->corpo);
                    session()->put('user_id',$cards[0]->user_id);
                }else{
                    session()->put('fidelity','0');
                }
                return redirect('/dashboard/fidelity');                
                break;
            case '9':
                return view('admin.mainpage_admin')->with(['title' => 'Main Page','user' => $user]);        
                break;
        }
        
        
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
            return redirect('login_fidelity');
        }

        return redirect()->back()->withErrors(['errors' => "Errore nella creazione dell'utente" ]);

    }
}
