<?php

namespace App\Http\Controllers;

use App\Models\Casse;
use App\Models\Depositi;
use App\Models\FidelityCard;
use App\Models\Shop;
use App\Models\TestataScontrino;
use App\Models\Till;
use App\Models\TransactionHeader;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show(string $page){  
        $user = session('user');
        $notification = '';
        switch ($user->type) {
            case '0':                
                return view('users.account.accountpage')->with(['title' => 'Account','user' => $user,'index' => 0 ,'page' => $page,'notification' => $notification]);
                break;
            
            case '1':
                $cards = FidelityCard::GetFidelityList($user->id);                
                return view('users.account.accountfidelity')->with(['title' => 'Account','user' => $user ,'page' => $page,'cards' => $cards,'notification' => $notification]);
                break;
            case '9':
                return view('users.account.accountadmin')->with(['title' => 'Account','user' => $user ,'page' => $page,'notification' => $notification]);                
                break;        
        }                    
    }

    private function AggiornaData($request)
    {
        if (isset($request->newdate)){
            return new DateTime($request->newdate);            
        } else {
            return new DateTime('now'); 
        }   
    }

    public function deposito(string $newdata,string $id_deposito)
    {
        $user = session('user'); 
        $data = new DateTime($newdata);
        
        $total['date'] = $data->format('Y-m-d');

        // calcolo importo giornaliero
        $total['day'] = TestataScontrino::TotaleGiorno(new DateTime($newdata),$id_deposito,0);
        // calcolo importi settimanali
        $total['week'] = TestataScontrino::TotaleSettimana(new DateTime($newdata),$id_deposito,0);
        
        // calcolo importo mensile
        $total['month'] = TestataScontrino::TotaleMese(new DateTime($newdata),$id_deposito,0);
        
        // calcolo totale casse       
        $total['tills'] = TestataScontrino::TotaleCasse(new DateTime($newdata),$id_deposito);

        $total['name'] = Depositi::GetName($id_deposito);
        $total['shopid'] = $id_deposito;
        $total['tillid'] = '';
        return view('users.mainpage')->with(['title' => 'Main Page','user' => $user,'index' => '1', 'total' => $total]);                

    }

    public function cassa(string $newdata,string $id_cassa)
    {
        $user = session('user'); 
        $data = new DateTime($newdata);

        
        $total['date'] = $data->format('Y-m-d');

        // calcolo importo giornaliero
        $total['day'] = TestataScontrino::Totalegiorno(new DateTime($newdata),0,$id_cassa);
        // calcolo importi settimanali
        $total['week'] = TestataScontrino::TotaleSettimana(new DateTime($newdata),0,$id_cassa);
        
        // calcolo importo mensile
        $total['month'] = TestataScontrino::TotaleMese(new DateTime($newdata),0,$id_cassa);
        
        // calcolo totale casse
        $total['tills'] = [];

        $total['name'] = Casse::GetName($id_cassa);
        $total['tillid'] = $id_cassa;
        $total['shopid'] = '';
        
        // $total['tills'] = TransactionHeader::TotalTills($user->id,new DateTime($newdata));
        return view('users.mainpage')->with(['title' => 'Main Page','user' => $user,'index' => '1', 'total' => $total]);                

    }

    public function dash(Request $request){                   
        $user = session('user');        
        $data = $this->AggiornaData($request);
        
        $total['date'] = $data->format('Y-m-d');
        
        // calcolo importo giornaliero
        $total['day'] = TestataScontrino::Totalegiorno($this->AggiornaData($request),0,0);
        
        // calcolo importi settimanali
        $total['week'] = TestataScontrino::TotaleSettimana($this->AggiornaData($request),0,0);
        
        // calcolo importo mensile
        $total['month'] = TestataScontrino::TotaleMese($this->AggiornaData($request),0,0);
        
        // calcolo totale casse
        $total['tills'] = TestataScontrino::TotaleCasse($this->AggiornaData($request),0);

        $total['name'] = '';
        $total['tillid'] = '';
        $total['shopid'] = '';      
        return view('users.mainpage')->with(['title' => 'Main Page','user' => $user, 'index' => '1', 'total' => $total]);                
    }

    public function save(Request $request,$page){                
        switch ($page) {
            case '1':
                $result['title'] = 'Gestione Cassieri';
                $tmp = User::modify_user($request,session('user'));                                    
                $result['message'] = $tmp['message'];
                $result['error'] = $tmp['error'];                            
                break;            
            case '2':
                $notification = User::changePassword($request,session('user'));                                    
                break;
        }  
        session()->flash('result',$result);        
        return redirect()->back();      
        // return view('users.account.accountpage')->with(['title' => 'Account','user' => $user,'index' => '0' ,'page' => $page]);        
    }
    
}
