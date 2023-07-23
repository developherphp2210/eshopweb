<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'id',
        'user_id',
        'code',
        'description'
    ];

    static function GetPaymentId($request){        
        $payment = Payment::updateorCreate(
            ['user_id'=> $request->user_id,'code' => $request->codtend],
            ['description' => $request->destend]
        );
        return $payment->id;
    }
}
