<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDiscount extends Model
{
    use HasFactory;

    protected $table = 'transaction_discount';

    public $timestamps = false;

    protected $fillable = [
        'transaction_id',        
        'discount',
        'description',
        'type'
    ];

    static function InsertTransactionDiscount($request,$tipo): string
    {
        TransactionDiscount::create([
            'transaction_id' => $request->trans_id,
            'discount' => str_replace(',','.',$request->sconti),
            'description' => $request->desean,
            'type' => $tipo
        ]);
        return $request->trans_id;
    }

    static function SingleReceipt($id){
        return TransactionDiscount::where('transaction_header.id',$id)
                                  ->join('transaction_header','transaction_header.id','=','transaction_discount.transaction_id') 
                                  ->selectRaw('transaction_discount.description,transaction_discount.discount')
                                  ->get();
    }
}
