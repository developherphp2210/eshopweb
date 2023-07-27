<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FidelityCard extends Model
{
    use HasFactory;

    protected $table = 'fidelity_card';

    protected $fillable=[
         'customer_id',
         'user_id'         
    ];

    public $timestamps = false;

    static function GetFidelityList($id){
        return FidelityCard::where('fidelity_card.user_id',$id)
                           ->join('customers','customers.id','=','fidelity_card.customer_id')
                           ->join('users','users.id','=','customers.user_id')
                           ->join('settings','users.id','=','settings.user_id')
                           ->selectRaw('customers.codice_fidelity, users.user_name, users.id as user_id, customers.id as customer_id, customers.punti, settings.testata, settings.corpo, settings.filepdf')
                           ->get();

    }

    static function AddFidelity($id,$card){

        $customerid = Customer::where('codice_fidelity',$card)->first();
         
        FidelityCard::create([
            'customer_id' => $customerid->id,
            'user_id' => $id
        ]);
    }
    
    static function TransactionFidelityList($customerid){
        return TransactionHeader::where('transaction_header.customer_id',$customerid)
                               ->join('tills','tills.id','=','transaction_header.till_id')
                               ->join('shops','shops.id','=','transaction_header.shop_id')
                               ->join('cashiers','cashiers.id','=','transaction_header.cashier_id')
                               ->selectRaw('transaction_header.id,transaction_header.data,transaction_header.amount,transaction_header.discount,transaction_header.points,transaction_header.points_jolly,tills.description AS cassa,shops.description AS negozio,cashiers.description AS cassiere')
                               ->orderbyRaw(' transaction_header.data desc,transaction_header.shop_id')
                               ->get();
    }
}
