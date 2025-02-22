<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CVolantino extends Model
{
    use HasFactory;

    protected $table = 'corpo_volantino';

    protected $fillable = [
        'id',  
        'id_testata',
        'id_articolo',
        'id_offerta',
        'prezzo_iniziale',
        'prezzo_offerta',
        'valore_sconto'
    ]; 

    static function GetListCasse($idcassa)
    {
        // $lastupdate = Casse::LastUpdate($idcassa);        
        // if ( $lastupdate <> null )
        // {
        //     return CVolantino::whereRaw("testata_volantino.updated_at >= '".$lastupdate."' or testata_volantino.updated_at is null")
        //                     ->where('casse.id',$idcassa)
        //                     ->join('testata_volantino','testata_volantino.id','=','corpo_volantino.id_testata')
        //                     ->join('depositi_volantino','depositi_volantino.id_testata','=','testata_volantino.id')
        //                     ->join('casse','casse.id_deposito','=','depositi_volantino.id_deposito')
        //                     ->selectRaw('testata_volantino.data_inizio,testata_volantino.data_fine,corpo_volantino.id_testata,corpo_volantino.id_articolo,corpo_volantino.id_offerta,corpo_volantino.prezzo_iniziale,corpo_volantino.prezzo_offerta,corpo_volantino.valore_sconto')
        //                     ->get();
        // } else 
        // {
            return CVolantino::whereRaw("testata_volantino.data_fine >= '".now()."'")
                            ->where('casse.id',$idcassa)
                            ->join('testata_volantino','testata_volantino.id','=','corpo_volantino.id_testata')
                            ->join('depositi_volantino','depositi_volantino.id_testata','=','testata_volantino.id')
                            ->join('casse','casse.id_deposito','=','depositi_volantino.id_deposito')
                            ->selectRaw('testata_volantino.data_inizio,testata_volantino.data_fine,corpo_volantino.id_testata,corpo_volantino.id_articolo,corpo_volantino.id_offerta,corpo_volantino.prezzo_iniziale,corpo_volantino.prezzo_offerta,corpo_volantino.valore_sconto')
                            ->get();
        // }
    }
}
