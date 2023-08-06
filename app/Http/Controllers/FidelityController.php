<?php

namespace App\Http\Controllers;

use App\Models\FidelityCard;
use App\Models\Settings;
use App\Models\TransactionBody;
use App\Models\TransactionDiscount;
use App\Models\TransactionHeader;
use App\Models\TransactionPayment;
use Illuminate\Http\Request;

class FidelityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = session('user');
        $cards = FidelityCard::GetFidelityList($user->id);
        $transactions = FidelityCard::TransactionFidelityList(session('customer_id'));
        return view('fidelity.receipt_list')->with(['title' => 'Lista Transazioni','user' => $user,'cards' => $cards,'transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = session('user');
        $result = FidelityCard::AddFidelity($request->id,$request->fidelitycard);
        $cards = FidelityCard::GetFidelityList($user->id);
        if ($result){
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['errors' => "Tessera Fidelity non Trovata" ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {          
        $user = session('user');
        $cards = FidelityCard::GetFidelityList($user->id);
        $receipt['setting'] = Settings::GetMySetting(session('user_id'));        
        $receipt['header'] = TransactionHeader::GetMyTransaction($id);
        $receipt['body'] = TransactionBody::SingleReceipt($id);
        $receipt['payment'] = TransactionPayment::SingleReceipt($id);
        $receipt['discount'] = TransactionDiscount::SingleReceipt($id);
        return view('fidelity.receipt')->with(['title' => 'Scontrino','user' => $user,'cards' => $cards,'receipt' => $receipt]);
    }

    public function dash(){
        $user = session('user');
        $cards = FidelityCard::GetFidelityList($user->id);
        if ($cards->count() > 0){
            return view('fidelity.mainpage')->with(['title' => 'Main Page','user' => $user,'cards' => $cards]);
        } else {
            return redirect('/account/profile/3');
        }        
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changeCard(string $id){
        $user = session('user');
        (new self)->SelectCard($id,$user->id);       
        return redirect()->back();
    }

    private function SelectCard($id,$userid){
        $cards = FidelityCard::GetFidelityList($userid);       
        foreach ($cards as $card){                 
            if ($card->user_id == $id){                
                session()->put('customer_id',$card->customer_id);
                session()->put('user_name',$card->user_name);
                session()->put('codice_fidelity',$card->codice_fidelity);  
                session()->put('punti_fidelity',$card->punti);
                session()->put('testata',$card->testata);
                session()->put('corpo',$card->corpo); 
                session()->put('user_id',$card->user_id);
                session()->put('filepdf',$card->filepdf);             
            }
        } 
    }
}
