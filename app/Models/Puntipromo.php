<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntipromo extends Model
{
    use HasFactory;

    protected $table = 'puntipromo';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_promo',
        'id_fidelity',
        'punti'
    ];

    static function RichiestaPunti($id_fidelity)
    {
        return Puntipromo::where('id_fidelity',$id_fidelity)->get();
    }

    static function InserisciPunti($idfidelity,$idpromo,$totpunti)
    {
        $punti = Puntipromo::where('id_promo',$idpromo)->where('id_fidelity',$idfidelity)->first();
        if ($punti != '' ){
            $punti->punti = $punti->punti + $totpunti;
            $punti->save();
        }else{
            Puntipromo::create([
                'id_promo' => $idpromo,
                'id_fidelity' => $idfidelity,
                'punti' => $totpunti
            ]);
        };
    }
}
