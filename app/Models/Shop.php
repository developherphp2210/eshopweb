<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';

    protected $fillable = [
        'id',
        'user_id',
        'code',
        'description'
    ];

    static function GetShopId($request){
        $shop = Shop::updateorCreate(
            ['user_id'=> $request->user_id,'code' => $request->deposito <> null ? $request->deposito : '1'],
            ['description' => 'Deposito '.$request->deposito]
        );

        return $shop->id;

    }

    static function GetNameShop($shopid){
        return Shop::where('id',$shopid)
                    ->select('description')
                    ->first();
    }
}
