<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class TransactionPayment extends Model
{
    use HasFactory;

    protected $table = 'transaction_payment';

    public $timestamps = false;

    protected $fillable = [
        'transaction_id',
        'payments_id',
        'amount'
    ];

    static function InsertTransactionPayment($request){
        TransactionPayment::create([
            'transaction_id' => $request->trans_id,
            'payments_id' => Payment::GetPaymentId($request),
            'amount' => str_replace(',','.',$request->imptend)
        ]);
        return $request->trans_id;
    }

    static function Payments($data,$userid,$shoptill){
        if ($shoptill != '0'){
            $id = substr($shoptill,5,strlen($shoptill)-5);
            switch (substr($shoptill,0,4)) {
                case 'shop':
                    return (new self)->QueryShop($userid,$data,$id);
                    break;
                
                case 'till':
                    return (new self)->QueryTill($userid,$data,$id);
                    break;                
            }
        } else {
            return (new self)->QueryNoShopTill($userid,$data);
        }
    }

    private function QueryNoShopTill($userid,$data){
        return TransactionPayment::whereRaw("transaction_header.user_id = ".$userid." and date(transaction_header.data) = '".$data->format('Y-m-d')."'")
                                 ->join('transaction_header','transaction_header.id','=','transaction_payment.transaction_id')
                                 ->join('payments','payments.id','=','transaction_payment.payments_id') 
                                 ->selectRaw(' sum(transaction_payment.amount) as totale, payments.description ')
                                 ->groupBy('payments.description')
                                 ->orderByRaw('totale desc')
                                 ->limit(10)
                                 ->get();
    }

    private function QueryShop($userid,$data,$shopid){
        return TransactionPayment::whereRaw("transaction_header.user_id = ".$userid." and date(transaction_header.data) = '".$data->format('Y-m-d')."' and transaction_header.shop_id = ".$shopid)
                                 ->join('transaction_header','transaction_header.id','=','transaction_payment.transaction_id')
                                 ->join('payments','payments.id','=','transaction_payment.payments_id') 
                                 ->selectRaw(' sum(transaction_payment.amount) as totale, payments.description ')
                                 ->groupBy('payments.description')
                                 ->orderByRaw('totale desc')
                                 ->limit(10)
                                 ->get();
    }

    private function QueryTill($userid,$data,$tillid){
        return TransactionPayment::whereRaw("transaction_header.user_id = ".$userid." and date(transaction_header.data) = '".$data->format('Y-m-d')."' and transaction_header.till_id = ".$tillid)
                                 ->join('transaction_header','transaction_header.id','=','transaction_payment.transaction_id')
                                 ->join('payments','payments.id','=','transaction_payment.payments_id') 
                                 ->selectRaw(' sum(transaction_payment.amount) as totale, payments.description ')
                                 ->groupBy('payments.description')
                                 ->orderByRaw('totale desc')
                                 ->limit(10)
                                 ->get();
    }

    static function SingleReceipt($id){
        return TransactionPayment::where('transaction_header.id',$id)
                                 ->join('transaction_header','transaction_header.id','=','transaction_payment.transaction_id') 
                                 ->join('payments','payments.id','=','transaction_payment.payments_id')
                                 ->selectRaw('transaction_payment.amount,payments.description')
                                 ->get();
    }
}
