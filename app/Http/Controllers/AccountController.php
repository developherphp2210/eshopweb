<?php

namespace App\Http\Controllers;

use App\Models\FidelityCard;
use App\Models\Shop;
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

    public function shop(string $newdata,string $shop_id)
    {
        $user = session('user'); 
        $data = new DateTime($newdata);

        $total['sessionid'] = $user->id;
        $total['date'] = $data->format('Y-m-d');

        // calcolo importo giornaliero
        $total['day'] = TransactionHeader::TotalDay($user->id,new DateTime($newdata),$shop_id,0);
        // calcolo importi settimanali
        $total['week'] = TransactionHeader::TotalWeek($user->id,new DateTime($newdata),$shop_id,0);
        
        // calcolo importo mensile
        $total['month'] = TransactionHeader::TotalMonth($user->id,new DateTime($newdata),$shop_id,0);
        
        // calcolo totale casse       
        $total['tills'] = TransactionHeader::TotalTills($user->id,new DateTime($newdata),$shop_id);

        $total['name'] = Shop::GetNameShop($shop_id);
        $total['shopid'] = $shop_id;
        $total['tillid'] = '';
        return view('users.mainpage')->with(['title' => 'Main Page','user' => $user, 'total' => $total]);                

    }

    public function till(string $newdata,string $till_id)
    {
        $user = session('user'); 
        $data = new DateTime($newdata);

        $total['sessionid'] = $user->id;
        $total['date'] = $data->format('Y-m-d');

        // calcolo importo giornaliero
        $total['day'] = TransactionHeader::TotalDay($user->id,new DateTime($newdata),0,$till_id);
        // calcolo importi settimanali
        $total['week'] = TransactionHeader::TotalWeek($user->id,new DateTime($newdata),0,$till_id);
        
        // calcolo importo mensile
        $total['month'] = TransactionHeader::TotalMonth($user->id,new DateTime($newdata),0,$till_id);
        
        // calcolo totale casse
        $total['tills'] = [];

        $total['name'] = Till::GetNameTill($till_id);
        $total['tillid'] = $till_id;
        $total['shopid'] = '';
        
        // $total['tills'] = TransactionHeader::TotalTills($user->id,new DateTime($newdata));
        return view('users.mainpage')->with(['title' => 'Main Page','user' => $user, 'total' => $total]);                

    }

    public function dash(Request $request){                   
        $user = session('user');        
        $data = $this->AggiornaData($request);
        $total['sessionid'] = $user->id;
        $total['date'] = $data->format('Y-m-d');
        
        // calcolo importo giornaliero
        $total['day'] = TransactionHeader::TotalDay($user->id,$this->AggiornaData($request),0,0);
        
        // calcolo importi settimanali
        $total['week'] = TransactionHeader::TotalWeek($user->id,$this->AggiornaData($request),0,0);
        
        // calcolo importo mensile
        $total['month'] = TransactionHeader::TotalMonth($user->id,$this->AggiornaData($request),0,0);
        
        // calcolo totale casse
        $total['tills'] = TransactionHeader::TotalTills($user->id,$this->AggiornaData($request),0);

        $total['name'] = '';
        $total['tillid'] = '';
        $total['shopid'] = '';      
        return view('users.mainpage')->with(['title' => 'Main Page','user' => $user, 'index' => '1', 'total' => $total]);                
    }

    public function save(Request $request,$page){        
        $user = session('user');
        switch ($page) {
            case '1':
                $notification = User::modify_user($request,$user);                                    
                break;            
            case '2':
                $notification = User::changePassword($request,session('user'));                                    
                break;
        }        
        return view('users.account.accountpage')->with(['title' => 'Account','user' => $user,'page' => $page, 'notification' => $notification]);        
    }
    
}
