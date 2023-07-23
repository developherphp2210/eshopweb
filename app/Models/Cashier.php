<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory;

    protected $table = 'cashiers';

    protected $fillable = [
        'id',
        'user_id',
        'code',
        'description'
    ];

    static function GetCashierId($request){
        $cashier = Cashier::updateorCreate(
            ['user_id'=> $request->user_id,'description' => $request->codoper]
        );
        return $cashier->id;
    }
}
