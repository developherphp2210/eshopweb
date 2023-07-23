<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{
    use HasFactory;

    protected $table = 'vats';

    protected $fillable = [
        'id',
        'user_id',
        'code',
        'descriptions',
        'rate'
    ];

    static function InsertVat($request):void
    {
        Vat::updateorCreate(
            ['user_id'=> $request->user_id,'code' => $request->codiva],
            ['descriptions' => $request->desiva,
            'rate' => $request->aliquota]             
        );
    }

    static function GetVatId($request){
        $vat = Vat::where('user_id',$request->user_id)
                  ->where('code',$request->codiva)
                  ->first();
        return $vat <> null ? $vat->id : '0';
    }
}
