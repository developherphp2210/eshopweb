<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * 
     * @var string
     * 
     */
    
     protected $table = 'customers';

     protected $fillable=[
        'id',
        'user_id',
        'codice_fidelity',
        'ragsoc',
        'indirizzo',
        'cap',
        'citta',
        'prov',
        'tel',
        'codfisc',
        'email',
        'punti',
        'totale_vendita',
        'data_ultimo_scontrino',
        'cel'  
    ];

    static function InsertCustomer($request):void
    {
        Customer::updateorCreate(
            ['user_id'=> $request->user_id,'codice_fidelity' => $request->codcli],
            ['ragsoc' => $request->ragsoc, 
            'indirizzo' => $request->indirizzo,
            'cap' => $request->cap,
            'citta' => $request->citta,
            'prov' => $request->prov,
            'tel' => $request->tel,
            'cel' => $request->cel,
            'codfisc' => $request->codfisc,
            'email' => $request->emailcli,
            'punti' => $request->punti,
            'totale_vendita' => str_replace(',','.',$request->totven),
            'data_ultimo_scontrino' => $request->dataultimosco <> null ? str_replace('/','.',$request->dataultimosco) : null]
        );
    }

    static function GetCustomerId($request):string
    {
        $customer = Customer::where('user_id',$request->user_id)
                            ->where('codice_fidelity',$request->codcli)
                            ->first();                    
        return $customer <> null ? $customer->id : '0';
    }

    static function GetSingleCustomer($id)
    {
        return Customer::where('id',$id)->first();
    }

    static function GetCustomerTransaction($id)
    {
       $trans = Customer::where('customers.id',$id)                        
                        ->join('transaction_header','transaction_header.customer_id','=','customers.id') 
                        ->join('tills','tills.id','=','transaction_header.till_id')
                        ->join('shops','shops.id','=','transaction_header.shop_id')                        
                        ->join('cashiers','cashiers.id','=','transaction_header.cashier_id')
                        ->select('tills.description as cassa','shops.description as deposito','cashiers.description AS cassiere' , 'transaction_header.amount','transaction_header.discount'  ,'transaction_header.data' ,'transaction_header.transaction_number','transaction_header.id' )
                        ->get();
        return $trans;                
    }
}
