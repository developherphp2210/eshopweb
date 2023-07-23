<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Causal extends Model
{
    use HasFactory;

    protected $table = 'causal';

    protected $fillable = [
        'id',
        'user_id',
        'code',
        'description',
        'type'
    ];

    static function InsertCausal($request):void
    {
        Causal::updateorCreate(
            ['user_id'=> $request->user_id,'code' => $request->codcau],
            ['description' => $request->descau,
            'type' => $request->tipcau]
        );
    }

    static function GetCausalId($request){
        $causal = Causal::where('user_id', $request->user_id)
                        ->where('code', $request->codcau)
                        ->first();                        
        return $causal->id;
    }
}
