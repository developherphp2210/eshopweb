<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Till extends Model
{
    use HasFactory;

    protected $table = 'tills';

    protected $fillable = [
        'id',
        'user_id',
        'shop_id',
        'code',
        'description'
    ];

    static function GetTillId($request,$shopid){
        $till = Till::updateorCreate(
            ['user_id'=> $request->user_id,'shop_id' => $shopid,'code' => $request->codcassa],
            ['description' => 'Cassa '.$request->codcassa]
        );

        return $till->id;
    }

    static function GetNameTill($tillid){
        return Till::where('id',$tillid)
                    ->select('description')
                    ->first();
    }
}
