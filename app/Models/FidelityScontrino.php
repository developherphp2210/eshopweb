<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FidelityScontrino extends Model
{
    use HasFactory;

    protected $table = 'fidelity_scontrino';

    public $timestamps = false;

    protected $fillable = [
        'id_testata',
        'id_promo',
        'id_fidelity',
        'punti_precedenti',
        'punti_accumulati',
        'punti_jolly',
        'punti_senza_Accumulo',
        'id_offerta'
    ];

    static function MemorizzoFidelity($id,$data)
    {
        FidelityScontrino::create([
            'id_testata' => $id,
            'id_promo' => $data[1],
            'id_fidelity' => $data[2],
            'punti_precedenti' => $data[3],
            'punti_accumulati' => $data[4],
            'punti_jolly' => $data[5],
            'punti_senza_Accumulo' => $data[6],
            'id_offerta' => $data[7]
        ]);
    }

    static function ListaTransazioni($idcassa,$iddeposito,$data)
    {
        return FidelityScontrino::where('testata_scontrino.id_deposito',$iddeposito)
                                ->where('testata_scontrino.id_cassa',$idcassa)
                                ->whereRaw(" DATE(testata_scontrino.data) = '".$data."'")
                                ->join('testata_scontrino','testata_scontrino.id','=','fidelity_scontrino.id_testata')
                                ->selectRaw('fidelity_scontrino.id_promo,fidelity_scontrino.id_offerta,fidelity_scontrino.id_testata,fidelity_scontrino.id_fidelity,fidelity_scontrino.punti_precedenti,fidelity_scontrino.punti_accumulati,fidelity_scontrino.punti_jolly,fidelity_scontrino.punti_senza_accumulo ')
                                ->get();
    }

    static function SingolaTransazione($id)
    {
        return FidelityScontrino::where('fidelity_scontrino.id_testata',$id)
                                  ->join('fidelity_card','fidelity_card.id','=','fidelity_scontrino.id_fidelity')  
                                  ->join('promozioni','promozioni.id','=','fidelity_scontrino.id_promo')
                                  ->selectRaw('fidelity_card.descrizione,promozioni.descrizione as promo,fidelity_scontrino.punti_precedenti,fidelity_scontrino.punti_accumulati,fidelity_scontrino.punti_jolly,fidelity_scontrino.punti_senza_accumulo,(fidelity_scontrino.punti_precedenti+fidelity_scontrino.punti_accumulati+fidelity_scontrino.punti_jolly) as totpunti')
                                  ->get();
    }
}
