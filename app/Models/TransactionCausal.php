<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\Till;
use App\Models\Cashier;

class TransactionCausal extends Model
{
    use HasFactory;

    protected $table = 'transaction_causal';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'till_id',
        'shop_id',
        'cashier_id',
        'causal_id',
        'payments_id',
        'amount',
        'transaction_number',
        'data'
    ];

    public static function InsertTransactionCausal($request) {
		$shop_id = Shop::GetShopId($request);
        $transHeader = TransactionCausal::create([
            'user_id' => $request->user_id,
            'shop_id' => $shop_id,
            'till_id' => Till::GetTillId($request,$shop_id),            
            'cashier_id' => Cashier::GetCashierId($request),
            'amount' => str_replace(',','.',$request->verpre),
            'causal_id' => Causal::GetCausalId($request),
            'payments_id' => Payment::GetPaymentId($request),
            'data' => (new self)->ConverTimestamp($request->datatransaction),
            'transaction_number' => $request->numtrans,            
        ]);
        return $transHeader->id;        
	}

	private function ConverTimestamp($data){        
        return substr($data,6,4).'-'.substr($data,3,2).'-'.substr($data,0,2).' '.substr($data,11,8);
    }
}
